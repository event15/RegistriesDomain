Feature: As user
  I want to be able to add new car.

  Scenario:
    When I add a new car following data:
      |carRegistrationNumber|model     |expireDate|
      |GDA15567             |Opel Astra|2016-12-30|
    Then "car" list should contain following data:
      |carRegistrationNumber|model     |expireDate|
      |GDA15567             |Opel Astra|2016-12-30|