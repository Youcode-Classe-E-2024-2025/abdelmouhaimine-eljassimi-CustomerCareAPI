<?php

namespace Tests\Unit;

use App\Services\AuthService;
use App\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Mockery;
use PHPUnit\Framework\TestCase;

class AuthServiceTest extends TestCase
{
    protected $userRepositoryMock;
    protected $authService;

    public function setUp(): void
    {
        parent::setUp();
        // Mock UserRepository
        $this->userRepositoryMock = Mockery::mock(UserRepository::class);
        $this->authService = new AuthService($this->userRepositoryMock);
    }

    public function test_register_creates_user_if_not_exists()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password123',
            'role' => 'user'
        ];

        $this->userRepositoryMock
            ->shouldReceive('findByEmail')
            ->with($data['email'])
            ->andReturnNull();

        $this->userRepositoryMock
            ->shouldReceive('create')
            ->with([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => $data['role']
            ])
            ->andReturn(new User([
                'name' => $data['name'],
                'email' => $data['email'],
                'role' => $data['role']
            ]));

        $result = $this->authService->register($data);

        $this->assertEquals('User created successfully', $result['message']);
        $this->assertObjectHasAttribute('name', $result['user']);
    }

    public function test_login_succeeds_with_valid_credentials()
    {
        $data = [
            'email' => 'johndoe@example.com',
            'password' => 'password123'
        ];

        // Mock the user
        $user = Mockery::mock(User::class);
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);

        // Mock the repository's findByEmail method
        $this->userRepositoryMock
            ->shouldReceive('findByEmail')
            ->with($data['email'])
            ->andReturn($user);

        // Mock the Hash::check method
        Hash::shouldReceive('check')
            ->with($data['password'], $user->password)
            ->andReturn(true);

        // Mock the Auth::login method
        Auth::shouldReceive('login')
            ->with($user)
            ->once();

        $result = $this->authService->login($data);

        $this->assertArrayHasKey('token', $result);
    }

    public function test_logout_deletes_tokens()
    {
        $user = Mockery::mock(User::class);
        $user->shouldReceive('tokens')
            ->andReturn(Mockery::mock([
                'delete' => true
            ]));

        $result = $this->authService->logout($user);

        $this->assertEquals('Logged out', $result['message']);
    }
}
