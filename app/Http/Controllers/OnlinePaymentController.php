<?php

namespace App\Http\Controllers;

use App\Classs;
use App\Repositories\Attend\AttendRepository;
use App\Repositories\OrderClass\OrderClassRepository;
use App\Repositories\Students\StudentsRepository;
use App\Repositories\Teachers\TeachersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnlinePaymentController extends Controller
{
    protected $student, $teacher, $attend, $order_class;

    /**
     * OnlinePaymentController constructor.
     *
     * @param StudentsRepository $studentsRepository
     * @param TeachersRepository $teacherRepository
     * @param AttendRepository $attendRepository
     * @param OrderClassRepository $orderClassRepository
     */
    public function __construct(
        StudentsRepository $studentsRepository,
        TeachersRepository $teacherRepository,
        AttendRepository $attendRepository,
        OrderClassRepository $orderClassRepository
    ) {
        $this->student     = $studentsRepository;
        $this->attend      = $attendRepository;
        $this->teacher     = $teacherRepository;
        $this->order_class = $orderClassRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $classId = $request->class_id;
            $price = Classs::find($classId)->price;
            $orderClass = $this->order_class->addOrderClassByCourse($classId, $price);
        } catch (\Exception $e)
        {
            return redirect()->route('courses_cost.index');
        }


        return view('payment.index', compact('orderClass'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $amount = $this->order_class->getOrderClassByKey($request->order_id)->price;
        session(['cost_id' => $request->id]);
        session(['url_prev' => url()->previous()]);
        $vnp_TmnCode = "O8EK1ABR"; //Mã website tại VNPAY
        $vnp_HashSecret = "YGVYQKEFQCWSXNWBCASDBSIOWQKSEHOM"; //Chuỗi bí mật
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_ReturnUrl = route('return_payment_class.index');
        $vnp_TxnRef = $request->order_id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán hóa đơn phí dich vụ";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $amount * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = $request->bank_code;
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_ReturnUrl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showReturn()
    {
        $vnp_Amount = $_GET['vnp_Amount'];
        $user_id = Auth::id();
        if ($_GET['vnp_ResponseCode'] == 00 && Auth::check())
            $this->student->addMoney($user_id, ($vnp_Amount / 100));

        return view('payment.vnpay_return');
    }

    public function showReturnRegisterClass()
    {
        $data = $this->order_class->getOrderClassByKey($_GET['vnp_TxnRef']);

        if ($_GET['vnp_ResponseCode'] == 00 && Auth::check()) {
            $this->attend->registerCourse([
                'student_id' => $data->user_id,
                'class_id'   => $data->class_id,
                'user_id'    => Auth::id()
            ]);
            $this->order_class->updateOrderClassSucess($data->key);
        }

        return redirect()->route('courses_cost.index')->with('thongbao', 'Bạn đã thanh toán thành công');
    }


}

