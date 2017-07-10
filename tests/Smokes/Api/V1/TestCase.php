<?php
namespace Tests\Smokes\Api\V1;

use App\Models\User;
use Laravel\Passport\ClientRepository;
use Tests\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /** @var bool */
    protected $useDatabase = true;

    protected $clientName = 'TEST_CLIENT';

    public function setUp()
    {

        //        exec('php artisan migrate --database testing');
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
        //        exec('php artisan migrate:rollback --database testing');
    }

    protected function getClientIdAndSecret()
    {
        $client = \DB::table('oauth_clients')->where('name', $this->clientName)->first();
        if (empty($client)) {
            $clients = new ClientRepository();
            $client  = $clients->createPasswordGrantClient(
                null, $this->clientName, 'http://localhost'
            );
        }

        return [$client->id, $client->secret];
    }

    /**
     * @return array
     */
    protected function getAuthenticationHeader()
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

        $response = $this->call('POST', '/api/v1/signin', $input, [], [],
            $this->transformHeadersToServerVars($headers));
        $data = json_decode($response->getContent(), true);

        $type  = $data['tokenType'];
        $token = $data['accessToken'];

        $headers = [
            'Authorization' => $type.' '.$token,
        ];

        return $headers;
    }
}
