<?php

namespace App\Services\Production;

use App\Repositories\UserRepositoryInterface;
use App\Repositories\UserServiceAuthenticationRepositoryInterface;
use App\Services\UserServiceAuthenticationServiceInterface;
use App\Services\UserServiceInterface;
use LaravelRocket\ServiceAuthentication\Services\Production\ServiceAuthenticationService;

class UserServiceAuthenticationService extends ServiceAuthenticationService implements UserServiceAuthenticationServiceInterface
{
    /** @var \App\Repositories\UserServiceAuthenticationRepositoryInterface */
    protected $serviceAuthenticationRepository;

    /** @var \App\Repositories\UserRepositoryInterface */
    protected $authenticatableRepository;

    /** @var UserServiceInterface */
    protected $authenticatableService;

    public function __construct(
        UserRepositoryInterface $authenticatableRepository,
        UserServiceAuthenticationRepositoryInterface $serviceAuthenticationRepository,
        UserServiceInterface $authenticatableService
    ) {
        parent::__construct($authenticatableRepository, $serviceAuthenticationRepository, $authenticatableService);
        $this->authenticatableRepository = $authenticatableRepository;
        $this->serviceAuthenticationRepository = $serviceAuthenticationRepository;
        $this->authenticatableService = $authenticatableService;
    }
}
