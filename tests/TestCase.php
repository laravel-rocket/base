<?php
namespace Tests;

use App\Models\User;
use Laravel\Passport\ClientRepository;
use LaravelRocket\Foundation\Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /** @var bool */
    protected $useDatabase = false;

    /** @var string */
    public $baseUrl = 'http://localhost:8000';

    /** @var \Faker\Generator */
    protected $faker;

    protected $clientName = 'TEST_CLIENT';

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    protected function getClientIdAndSecret()
    {
        $client = \DB::table('oauth_clients')->where('name', $this->clientName)->first();
        if (empty($client)) {
            $clients = new ClientRepository();
            $client  = $clients->createPasswordGrantClient(
                null,
                $this->clientName,
                'http://localhost'
            );
        }

        return [$client->id, $client->secret];
    }

    /**
     * @return array
     */
    protected function getAuthenticationHeaders()
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

        $type  = $data['tokenType'];
        $token = $data['accessToken'];

        $headers = [
            'Authorization' => $type.' '.$token,
        ];

        return $headers;
    }
}
