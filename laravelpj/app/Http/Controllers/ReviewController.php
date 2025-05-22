<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\CrudProduct;

class ReviewController extends Controller
{
    // Lưu đánh giá sản phẩm
    public function storeReview(Request $request, $productId)
    {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (!session()->has('khach_hang')) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để đánh giá sản phẩm.');
        }

        // Validate dữ liệu
        $request->validate([
            'noi_dung' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Lấy ID khách hàng từ session
        $khachHang = session('khach_hang');

        // Tạo đánh giá
        Review::create([
            'product_id' => $productId,
            'khach_hang_id' => $khachHang->idKhach,
            'noi_dung' => $request->noi_dung,
            'rating' => $request->rating,
        ]);

        return redirect()->back()->with('success', 'Cảm ơn bạn đã đánh giá sản phẩm!');
    }
    public function destroy($id)
    {
        $review = \App\Models\Review::findOrFail($id);

        // Nếu bạn muốn chỉ cho phép khách đã đăng nhập xóa đánh giá của họ:
        if (session()->has('khach_hang') && $review->khach_hang_id != session('khach_hang')->idKhach) {
            return redirect()->back()->with('error', 'Bạn không có quyền xóa đánh giá này.');
        }

        $review->delete();
        return redirect()->back()->with('success', 'Đánh giá đã được xóa.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'noi_dung' => 'required|string|max:1000',
        ], [
            'noi_dung.required' => 'Bình luận không được để trống.',
            'noi_dung.max' => 'Bình luận không được vượt quá 1000 ký tự.',
        ]);

        $review = Review::findOrFail($id);

        if (session()->has('khach_hang') && $review->khach_hang_id != session('khach_hang')->idKhach) {
            return redirect()->back()->with('error', 'Bạn không có quyền chỉnh sửa đánh giá này.');
        }

        $review->update([
            'rating' => $request->rating,
            'noi_dung' => $request->noi_dung,
        ]);

        return redirect()->back()->with('success', 'Đánh giá đã được cập nhật.');
    }


}
