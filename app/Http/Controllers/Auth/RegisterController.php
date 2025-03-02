
use App\Models\Role;

// ...existing code...
<!-- 
protected function create(array $data)
{
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ]);

    // Assign default role
    $user->roles()->attach(Role::where('name', 'normal')->first());

    return $user;
} -->
