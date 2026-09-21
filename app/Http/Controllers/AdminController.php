<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\Post;
use App\Models\FeeType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // ─── USERS ───────────────────────────────────────────────────────────────────

    public function users(Request $request)
    {
        $query = User::with('schoolClass');

        if ($request->role) {
            $query->where('role', $request->role);
        }
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%")
                  ->orWhere('identity_number', 'like', "%{$request->search}%");
            });
        }

        $users   = $query->latest()->paginate(20);
        $classes = SchoolClass::all();
        return view('admin.users.index', compact('users', 'classes'));
    }

    public function createUser()
    {
        $classes = SchoolClass::all();
        return view('admin.users.create', compact('classes'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email',
            'role'            => 'required|in:admin,guru,siswa,bendahara',
            'password'        => 'required|string|min:8',
            'identity_number' => 'nullable|string|max:20',
            'phone'           => 'nullable|string|max:20',
            'gender'          => 'required|in:L,P',
            'class_id'        => 'nullable|exists:classes,id',
            'address'         => 'nullable|string',
        ]);

        User::create([
            'name'            => $request->name,
            'email'           => $request->email,
            'role'            => $request->role,
            'password'        => Hash::make($request->password),
            'identity_number' => $request->identity_number,
            'phone'           => $request->phone,
            'gender'          => $request->gender,
            'class_id'        => $request->class_id,
            'address'         => $request->address,
        ]);

        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function editUser($id)
    {
        $user    = User::findOrFail($id);
        $classes = SchoolClass::all();
        return view('admin.users.edit', compact('user', 'classes'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role'  => 'required|in:admin,guru,siswa,bendahara',
        ]);

        $user->update($request->except(['password', '_token', '_method']) + [
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('admin.users')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Pengguna berhasil dihapus!');
    }

    // ─── POSTS ───────────────────────────────────────────────────────────────────

    public function posts(Request $request)
    {
        $posts = Post::with('author')
            ->when($request->category, fn($q) => $q->where('category', $request->category))
            ->latest('published_at')->paginate(20);
        return view('admin.posts.index', compact('posts'));
    }

    public function createPost()
    {
        return view('admin.posts.create');
    }

    public function storePost(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'required|in:berita,agenda,prestasi,pengumuman',
            'content'  => 'required|string',
            'excerpt'  => 'nullable|string|max:500',
        ]);

        Post::create([
            'title'        => $request->title,
            'slug'         => Str::slug($request->title) . '-' . Str::random(6),
            'category'     => $request->category,
            'content'      => $request->content,
            'excerpt'      => $request->excerpt,
            'is_featured'  => $request->boolean('is_featured'),
            'event_date'   => $request->event_date,
            'author_id'    => auth()->id(),
            'published_at' => now(),
        ]);

        return redirect()->route('admin.posts')->with('success', 'Artikel/Berita berhasil dipublikasikan!');
    }

    public function deletePost($id)
    {
        Post::findOrFail($id)->delete();
        return back()->with('success', 'Artikel berhasil dihapus!');
    }

    // ─── CLASSES ─────────────────────────────────────────────────────────────────

    public function classes()
    {
        $classes = SchoolClass::withCount('students')->get();
        return view('admin.classes.index', compact('classes'));
    }

    public function storeClass(Request $request)
    {
        $request->validate(['name' => 'required|string|max:50', 'academic_year' => 'required|string']);
        SchoolClass::create($request->only('name', 'academic_year', 'homeroom_teacher_name'));
        return back()->with('success', 'Kelas berhasil ditambahkan!');
    }
}
