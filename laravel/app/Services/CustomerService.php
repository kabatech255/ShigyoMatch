<?php

namespace App\Services;

use App\Repositories\CustomerRepository;
use App\Models\Customer;
use App\Models\User;
class CustomerService extends Service
{
  protected $customerRep;

  /**
   * CustomerService constructor.
   * @param CustomerRepository $customerRep
   */
  public function __construct(CustomerRepository $customerRep)
  {
    $this->customerRep = $customerRep;
  }

  public function all()
  {
    return $this->customerRep->all();
  }

  public function firstRegister($data)
  {
    // customersへの登録
    $customer = new Customer();
    $createdCustomer = $customer->createByUser($data);
    // usersへの登録
    $password = str_random(8);
    $data['login_id'] = str_random(12);
    $data['customer_id'] = $createdCustomer->id;
    $data['password'] = \Hash::make($password);

    $user = new User();
    $createdUser = $user->createByUser($data);

    // customer_profession_typeの登録
    $registerNumbers = json_decode($data['registerNumbers'], true);
    $professionIds = explode(',', $data['professionIds']);

    foreach($professionIds as $professionId){
      $professionTypes[$professionId] = ['register_number' => $registerNumbers[$professionId]];
    }
    $createdCustomer->professionTypes()->sync($professionTypes);
    $createdCustomer->origin = $password;
    $createdCustomer->login_id = $data['login_id'];

    return $createdCustomer;

  }

  /**
   * @param $customerId
   * @return mixed
   */
  public function customerById(int $customerId)
  {
    return $this->customerRep->customerById($customerId);
  }


}
