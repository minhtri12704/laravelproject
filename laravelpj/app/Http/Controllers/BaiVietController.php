<?php

namespace App\Http\Controllers;

use App\Models\BaiViet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class BaiVietController extends Controller
{
    // Hiển thị danh sách bài viết
    public function index()
    {
        $baiviets = BaiViet::orderBy('created_at', 'desc')->paginate(10);
        return view('Crud_user.Crud_Blog', compact('baiviets'));
    }

    // Hiển thị form thêm bài viết
    public function create()
    {
        return view('crud_user.Crud_BlogCreate');
    }

    // Lưu bài viết mới
    public function store(Request $request)
    {
        $request->validate([
    'tieude' => [
        'required',
        'string',
        'max:255',
        'regex:/^(?!.*  )(?! )[A-Za-z0-9À-ỹà-ỹ\s_-]+(?<! )$/u'
            ],
            'noidung' => [
                'required',
                'string',
                'regex:/^(?!.*  )[A-Za-z0-9À-ỹà-ỹ\s.,\-()!?"\':]+$/u'
            ],
            'hinhanh' => 'nullable|image|max:2048',
        ], [
            'tieude.required' => 'Tiêu đề là bắt buộc.',
            'tieude.string' => 'Tiêu đề phải là chuỗi ký tự.',
            'tieude.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'tieude.regex' => 'Tiêu đề không được chứa khoảng trắng đầu/cuối, khoảng trắng đôi hoặc ký tự đặc biệt.',

            'noidung.required' => 'Nội dung là bắt buộc.',
            'noidung.string' => 'Nội dung phải là chuỗi ký tự.',
            'noidung.regex' => 'Nội dung không được chứa khoảng trắng đôi hoặc ký tự đặc biệt không hợp lệ.',
        ]);

        if ($request->hasFile('hinhanh')) {
            $file = $request->file('hinhanh');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $path = 'images/' . $filename;
        }


        BaiViet::create([
            'tieude' => $request->tieude,
            'noidung' => $request->noidung,
            'hinhanh' => $path,
        ]);

        return redirect()->route('baiviet.index')->with('success', 'Thêm bài viết thành công!');
    }

    // Hiển thị form sửa
    public function edit($id)
    {
        try {
        session()->forget('_old_input');
        session()->forget('errors');

        $baiviet = BaiViet::findOrFail($id);
        return view('crud_user.Crud_BlogEdit', compact('baiviet'));

        } catch (ModelNotFoundException $e) {
            return redirect()->route('baiviet.index')->with('error', 'Bài viết đã bị xóa hoặc không còn tồn tại.');
        }
    }

    // Cập nhật bài viết
    public function update(Request $request, $id)
    {
        $baiviet = BaiViet::findOrFail($id);

        $request->validate([
    'tieude' => [
        'required',
        'string',
        'max:255',
        'regex:/^(?!.*  )(?! )[A-Za-z0-9À-ỹà-ỹ\s_-]+(?<! )$/u'
            ],
            'noidung' => [
                'required',
                'string',
                'regex:/^(?!.*  )[A-Za-z0-9À-ỹà-ỹ\s.,\-()!?"\':]+$/u'
            ],
            'hinhanh' => 'nullable|image|max:2048',
        ], [
            'tieude.required' => 'Tiêu đề là bắt buộc.',
            'tieude.string' => 'Tiêu đề phải là chuỗi ký tự.',
            'tieude.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'tieude.regex' => 'Tiêu đề không được chứa khoảng trắng đầu/cuối, khoảng trắng đôi hoặc ký tự đặc biệt.',

            'noidung.required' => 'Nội dung là bắt buộc.',
            'noidung.string' => 'Nội dung phải là chuỗi ký tự.',
            'noidung.regex' => 'Nội dung không được chứa khoảng trắng đôi hoặc ký tự đặc biệt không hợp lệ.',
        ]);

        if ($request->hasFile('hinhanh')) {
            $file = $request->file('hinhanh');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $path = 'images/' . $filename;
        }


        $baiviet->tieude = $request->tieude;
        $baiviet->noidung = $request->noidung;
        $baiviet->save();

        return redirect()->route('baiviet.index')->with('success', 'Cập nhật bài viết thành công!');
    }

    // Xóa bài viết
    public function destroy($id)
    {
        $baiviet = BaiViet::findOrFail($id);

        // Xóa ảnh nếu có
        if ($baiviet->hinhanh && Storage::disk('public')->exists($baiviet->hinhanh)) {
            Storage::disk('public')->delete($baiviet->hinhanh);
        }

        $baiviet->delete();
        return redirect()->route('baiviet.index')->with('success', 'Xóa bài viết thành công!');
    }
}