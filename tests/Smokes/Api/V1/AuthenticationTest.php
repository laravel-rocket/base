<?php
namespace Tests\Smokes\Api\V1;

use App\Models\User;

class AuthenticationTest extends TestCase
{
    protected $useDatabase = true;

    public function testSignUp()
    {
        $headers = [];

        $email    = $this->faker->email;
        $password = $this->faker->password(8);

        list($clientId, $clientSecret) = $this->getClientIdAndSecret();

        $input = [
            'name'          => $this->faker->firstName,
            'email'         => $email,
            'password'      => $password,
            'gender'        => $this->faker->randomElement(['male', 'female']),
            'phone_number'  => $this->faker->phoneNumber,
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
        ];

        $response = $this->call(
            'POST',
            '/api/v1/signup',
            $input,
            [],
            [],
            $this->transformHeadersToServerVars($headers)
        );

        $data = json_decode($response->getContent(), true);

        $this->assertResponseStatus(201);
    }

    public function testSignUpWithoutParam()
    {
        $headers = [];

        $email    = $this->faker->email;
        $password = $this->faker->password(8);

        list($clientId, $clientSecret) = $this->getClientIdAndSecret();

        $input = [
        ];

        $response = $this->call(
            'POST',
            '/api/v1/signup',
            $input,
            [],
            [],
            $this->transformHeadersToServerVars($headers)
        );

        $data = json_decode($response->getContent(), true);

        $this->assertResponseStatus(400);
    }

    public function testSignIn()
    {
        $email    = $this->faker->email;
        $password = $this->faker->password(8);
        $user     = factory(User::class)->create([
            'email'    => $email,
            'password' => $password,
        ]);

        $headers = [];

        list($clientId, $clientSecret) = $this->getClientIdAndSecret();

        $input = [
            'email'         => $email,
            'password'      => $password,
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
        ];

        $response = $this->call(
            'POST',
            '/api/v1/signin',
            $input,
            [],
            [],
            $this->transformHeadersToServerVars($headers)
        );
        $data = json_decode($response->getContent(), true);
        $this->assertResponseStatus(200);
    }

    public function testSignOut()
    {
        $email    = $this->faker->email;
        $password = $this->faker->password(8);
        $user     = factory(User::class)->create([
            'email'    => $email,
            'password' => $password,
        ]);

        $headers = [];

        list($clientId, $clientSecret) = $this->getClientIdAndSecret();

        $input = [
            'email'         => $email,
            'password'      => $password,
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
        ];

        $response = $this->call(
            'POST',
            '/api/v1/signin',
            $input,
            [],
            [],
            $this->transformHeadersToServerVars($headers)
        );
        $data = json_decode($response->getContent(), true);
        $this->assertResponseStatus(200);

        $type  = $data['tokenType'];
        $token = $data['accessToken'];

        $headers = [
            'Authorization' => $type.' '.$token,
        ];

        $response = $this->call('POST', '/api/v1/signout', $input, [], [], $this->transformHeadersToServerVars($headers));
        $data     = json_decode($response->getContent(), true);
        $this->assertResponseStatus(200);
    }
}
