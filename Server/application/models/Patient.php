<?php

/**
 * The class represents a patient.
 * It defines also the structure of the database table for the ORM.
 *
 * @author Benjamin Oertel <mail@benjaminoertel.com>
 * @version 1.0
 * 
 * @Entity
 * @Table(name="patients")
 * @HasLifeCycleCallbacks
 */
class Application_Model_Patient{

  /**
   * The patient id that is a unique identifier for the patient.
   * @var integer The patient id.
   * 
   * @Id @Column(type="integer")
   * @GeneratedValue
   */
  private $id;

  /**
   * The patient firstname.
   * @var string The patient firstname.
   * 
   * @Column(type="string", length=64)
   */
  private $firstname;

  /**
   * The patient lastname.
   * @var string The patient lastname.
   * 
   * @Column(type="string", length=64)
   */
  private $lastname;

  /**
   * The patient street.
   * @var string The patient street.
   * 
   * @Column(type="string", length=64)
   */
  private $street;

  /**
   * The patient city.
   * @var string The patient city.
   * 
   * @Column(type="string", length=64)
   */
  private $city;

  /**
   * The patient zipcode.
   * @var string The patient zipcode.
   * 
   * @Column(type="string", length=5)
   */
  private $zipcode;

  /**
   * The patient weight in gramm.
   * @var string The patient weight in gramm.
   * 
   * @Column(type="integer", length=7)
   */
  private $weight;

  /**
   * The patient size in cm.
   * @var string The patient size in cm.
   * 
   * @Column(type="string", length=64)
   */
  private $size;
  /**
   * The patient sex.
   * @var string The patient sex.
   * 
   * @Column(type="string", length=6)
   */
  private $sex;
    /**
   * The patient birthday.
   * @var string The patient birthday.
   * 
   * @Column(type="date")
   */
  private $birthday;
  /**
   * The patient blood group.
   * @var string The patient blood group.
   * 
   * @Column(type="string", length=5)
   */
  private $bloodGroup;

  /**
   * @OneToOne(targetEntity="Application_Model_Rfid", mappedBy="patient")
   */
  private $rfid;

  /**
   * The patient rfid.
   * @var string The patient rfid.
   * 
   * @OneToMany(targetEntity="Application_Model_Hospital_Stay", mappedBy="patient")
   * @JoinColumn(name="hospital_stay_id_fk", referencedColumnName="id")
   */
  private $hospitalStays;

  /**
   * Constructor.
   */
  public function __construct($data){
    $this->hospitalStays = new \Doctrine\Common\Collections\ArrayCollection();

    if(isset($data["sex"])){
      $this->sex = $data["sex"];
    }
    if(isset($data["firstname"])){
      $this->firstname = $data["firstname"];
    }
    if(isset($data["lastname"])){
      $this->lastname = $data["lastname"];
    }
    if(isset($data["birthday"])){
      $this->birthday = $data["birthday"];
    }
    if(isset($data["street"])){
      $this->street = $data["street"];
    }
    if(isset($data["city"])){
      $this->city = $data["city"];
    }
    if(isset($data["zipcode"])){
      $this->zipcode = $data["zipcode"];
    }
    if(isset($data["weight"])){
      $this->weight = $data["weight"];
    }
    if(isset($data["size"])){
      $this->size = $data["size"];
    }
    if(isset($data["bloodGroup"])){
      $this->bloodGroup = $data["bloodGroup"];
    }
  }

  public function getId(){
    return $this->id;
  }

  public function getFirstname(){
    return $this->firstname;
  }

  public function getLastname(){
    return $this->lastname;
  }

  public function getStreet(){
    return $this->street;
  }

  public function getCity(){
    return $this->city;
  }

  public function getZipcode(){
    return $this->zipcode;
  }

  public function getWeight(){
    return $this->weight;
  }

  public function getSize(){
    return $this->size;
  }

  public function getBloodGroup(){
    return $this->bloodGroup;
  }

  public function getRfid(){
    return $this->rfid;
  }

  public function getHospitalStays(){
    return $this->hospitalStays;
  }

  public function getName(){
    return $this->firstname . " " . $this->lastname;
  }

  public function isCheckedIn(){
    foreach($this->hospitalStays as $hospitalStay){
      $checkOutDate = $hospitalStay->getCheckOut();
      if(empty($checkOutDate)){
        return true;
      }
    }
    return false;
  }

  public function setFirstname($firstname){
    $this->firstname = $firstname;
  }

  public function setLastname($lastname){
    $this->lastname = $lastname;
  }

  public function setStreet($street){
    $this->street = $street;
  }

  public function setCity($city){
    $this->city = $city;
  }

  public function setZipcode($zipcode){
    $this->zipcode = $zipcode;
  }

  public function setWeight($weight){
    $this->weight = $weight;
  }

  public function setSize($size){
    $this->size = $size;
  }

  public function setBloodGroup($bloodGroup){
    $this->bloodGroup = $bloodGroup;
  }

  public function getPatientData(){
    $patientData = "Patientendaten:<br /><br/>";
    $patientData .= "Name: " . $this->getName() . "<br />";

    if($this->bloodGroup){
      $patientData .= "Blutgruppe: " . $this->bloodGroup . "<br />";
    }
    if($this->size){
      $patientData .= "Körpergröße: " . $this->size . "cm<br />";
    }
    if($this->weight){
      $patientData .= "Gewicht: " . $this->weight . "kg<br />";
    }

    return $patientData;
  }
  
  public function setSex($sex){
    $this->sex = $sex;
  }

  public function setBirthday($birthday){
    $this->birthday = $birthday;
  }

  public function getSex(){
    return $this->sex;
  }

  public function getBirthday(){
    return $this->birthday;
  }



}