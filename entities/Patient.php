<?php
/**
 * Patient entity.
 *
 * Copyright (C) 2017 Robert Down <robertdown@live.com>
 *
 * LICENSE: This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://opensource.org/licenses/gpl-license.php>
 *
 * @package OpenEMR
 * @subpackage Patient
 * @author  Robert Down <robertdown@live.com>
 * @license GPL3
 * @link    http://www.open-emr.org
 */

namespace entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\GeneratedValue;

/**
 * Class Patient
 * @package entities
 * @Table(name="patient_data")
 * @Entity(repositoryClass="repositories\PatientRepository")
 */
class Patient
{

    public function __construct()
    {
    }

    /**
     * @Id()
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Prefix of name (Mr. Mrs., etc)
     * @var String
     * @Column(type="string")
     */
    private $title;

    /**
     * Preferred language of patient
     * @var String
     * @Column(name="language", type="string")
     */
    private $language;

    /**
     * @todo
     * @var String
     * @Column(name="financial", type="string")
     */
    private $financial;

    /**
     * @var String
     * @Column(name="fname", type="string")
     */
    private $firstName;

    /**
     * @var String
     * @Column(name="mName", type="string")
     */
    private $middleName;

    /**
     * @var String
     * @Column(name="lName", type="string")
     */
    private $lastName;

    /**
     * @var \DateTime
     * @Column(name="DOB", type="date")
     */
    private $dob;

    /**
     * @var String
     * @Column(name="street", type="string")
     */
    private $street;

    /**
     * @var String
     * @Column(name="city", type="string")
     */
    private $city;

    /**
     * @var String
     * @Column(name="state", type="string")
     */
    private $state;

    /**
     * @var String
     * @Column(name="postal_code", type="string")
     */
    private $postalCode;

    /**
     * @var String
     * @Column(name="country_code", type="string")
     */
    private $countryCode;

    /**
     * @Column(name="drivers_license", type="string")
     */
    private $driversLicense;

    /**
     * @Column(name="ss", type="string")
     */
    private $socialSecurity;

    /**
     * @Column(name="occupation", type="string")
     */
    private $occupation;

    /**
     * @Column(name="phone_biz", type="string")
     */
    private $businessPhone;

    /**
     * @Column(name="phone_contact", type="string")
     */
    private $contactPhone;

    /**
     * @Column(name="phone_cell", type="string")
     */
    private $cellPhone;

    /**
     * @Column(name="phone_home", type="string")
     */
    private $homePhone;

    /**
     * @todo Link pharmacy
     */
    private $pharmacy;

    /**
     * @todo Is this marital status?
     * @Column(name="status", type="string")
     */
    private $status;

    /**
     * @Column(name="contact_relationship", type="string")
     */
    private $contactRelationship;

    /**
     * @Column(name="date", type="string")
     */
    private $date;

    /**
     * @Column(name="country_code", type="string")
     */
    private $sex;

    /**
     * @todo Difference between referrer and referrerID?
     * @Column(name="", type="string")
     */
    private $referrer;

    /**
     * @Column(name="provider", type="string")
     */
    private $provider;

    /**
     * @todo
     * @Column(name="", type="string")
     */
    private $referringProvider;

    /**
     * @Column(name="email", type="string")
     */
    private $email;

    /**
     * @Column(name="email_direct", type="string")
     */
    private $emailDirect;

    /**
     * @Column(name="ethnoracial", type="string")
     */
    private $ethnoracial;

    /**
     * @Column(type="string")
     */
    private $race;

    /**
     * @Column(type="string")
     */
    private $ethnicity;

    /**
     * @Column(type="string")
     */
    private $religion;

    /**
     * @Column(type="string")
     */
    private $interpretter;

    /**
     * @Column(name="migrant_seasonal", type="string")
     */
    private $migrantSeasonal;

    /**
     * @Column(name="family_size", type="string")
     */
    private $familySize;

    /**
     * @Column(name="monthly_income", type="string")
     */
    private $monthlyIncome;

    /**
     * @Column(name="billing_note", type="string")
     */
    private $billingNote;

    /**
     * @Column(type="string")
     */
    private $homeless;

    /**
     * @Column(name="financial_review", type="string")
     */
    private $financialReview;

    /**
     * @Column(name="pub_pid", type="string")
     */
    private $pubPid;

    /**
     * @Id()
     * @Column(name="pid", type="bigint")
     */
    private $pid;

    /**
     * @Column(name="generic_name1", type="string")
     */
    private $genericName1;

    /**
     * @Column(name="generic_value1", type="string")
     */
    private $genericValue1;

    /**
     * @Column(name="generic_name2", type="string")
     */
    private $genericName2;

    /**
     * @Column(name="generic_value2", type="string")
     */
    private $genericValue2;

    /**
     * @Column(name="hipaa_mail", type="string")
     */
    private $hipaaMail;

    /**
     * @Column(name="hipaa_voice", type="string")
     */
    private $hipaaVoice;

    /**
     * @Column(name="hipaa_notice", type="string")
     */
    private $hipaaNotice;

    /**
     * @Column(name="hipaa_message", type="string")
     */
    private $hipaaMessage;

    /**
     * @Column(name="hipaa_sms", type="string")
     */
    private $hipaaSMS;

    /**
     * @Column(name="hipaa_email", type="string")
     */
    private $hipaaEmail;

    /**
     * @Column(type="string")
     */
    private $squad;

    /**
     * @Column(type="string")
     */
    private $fitness;

    /**
     * @Column(name="referral_source", type="string")
     */
    private $referralSource;

    /**
     * @Column(name="user_text1", type="string")
     */
    private $userText1;

    /**
     * @Column(name="user_text2", type="string")
     */
    private $userText2;

    /**
     * @Column(name="user_text3", type="string")
     */
    private $userText3;

    /**
     * @Column(name="user_text4", type="string")
     */
    private $userText4;

    /**
     * @Column(name="user_text5", type="string")
     */
    private $userText5;

    /**
     * @Column(name="user_text6", type="string")
     */
    private $userText6;

    /**
     * @Column(name="user_text7", type="string")
     */
    private $userText7;

    /**
     * @Column(name="user_text8", type="string")
     */
    private $userText8;

    /**
     * @Column(name="user_list1", type="string")
     */
    private $userList1;

    /**
     * @Column(name="user_list2", type="string")
     */
    private $userList2;

    /**
     * @Column(name="user_list3", type="string")
     */
    private $userList3;

    /**
     * @Column(name="user_list4", type="string")
     */
    private $userList4;

    /**
     * @Column(name="user_list5", type="string")
     */
    private $userList5;

    /**
     * @Column(name="user_list6", type="string")
     */
    private $userList6;

    /**
     * @Column(name="user_list7", type="string")
     */
    private $userList7;

    /**
     * @Column(name="price_level", type="string")
     */
    private $priceLevel;

    /**
     * @Column(name="reg_date", type="string")
     */
    private $regDate;

    /**
     * @Column(name="contra_start", type="string")
     */
    private $contraStart;

    /**
     * @Column(name="completed_ad", type="string")
     */
    private $completedAd;

    /**
     * @Column(name="ad_reviewed", type="string")
     */
    private $adReviewed;

    /**
     * @Column(name="vfc", type="string")
     */
    private $vfc;

    /**
     * @Column(name="mother_name", type="string")
     */
    private $motherName;

    /**
     * @Column(name="guardian_name", type="string")
     */
    private $guardianName;

    /**
     * @return Int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return String
     */
    public function getFinancial()
    {
        return $this->financial;
    }

    /**
     * @param String $financial
     */
    public function setFinancial($financial)
    {
        $this->financial = $financial;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return String
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * @param String $middleName
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;
    }

    /**
     * @return String
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param String $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return \DateTime
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * @param \DateTime $dob
     */
    public function setDob($dob)
    {
        $this->dob = $dob;
    }

    /**
     * @return String
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param String $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return String
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param String $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return String
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param String $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return String
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param String $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return String
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param String $countryCode
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    /**
     * @return mixed
     */
    public function getDriversLicense()
    {
        return $this->driversLicense;
    }

    /**
     * @param mixed $driversLicense
     */
    public function setDriversLicense($driversLicense)
    {
        $this->driversLicense = $driversLicense;
    }

    /**
     * @return mixed
     */
    public function getSocialSecurity()
    {
        return $this->socialSecurity;
    }

    /**
     * @param mixed $socialSecurity
     */
    public function setSocialSecurity($socialSecurity)
    {
        $this->socialSecurity = $socialSecurity;
    }

    /**
     * @return mixed
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * @param mixed $occupation
     */
    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;
    }

    /**
     * @return mixed
     */
    public function getBusinessPhone()
    {
        return $this->businessPhone;
    }

    /**
     * @param mixed $businessPhone
     */
    public function setBusinessPhone($businessPhone)
    {
        $this->businessPhone = $businessPhone;
    }

    /**
     * @return mixed
     */
    public function getContactPhone()
    {
        return $this->contactPhone;
    }

    /**
     * @param mixed $contactPhone
     */
    public function setContactPhone($contactPhone)
    {
        $this->contactPhone = $contactPhone;
    }

    /**
     * @return mixed
     */
    public function getCellPhone()
    {
        return $this->cellPhone;
    }

    /**
     * @param mixed $cellPhone
     */
    public function setCellPhone($cellPhone)
    {
        $this->cellPhone = $cellPhone;
    }

    /**
     * @return mixed
     */
    public function getHomePhone()
    {
        return $this->homePhone;
    }

    /**
     * @param mixed $homePhone
     */
    public function setHomePhone($homePhone)
    {
        $this->homePhone = $homePhone;
    }

    /**
     * @return mixed
     */
    public function getPharmacy()
    {
        return $this->pharmacy;
    }

    /**
     * @param mixed $pharmacy
     */
    public function setPharmacy($pharmacy)
    {
        $this->pharmacy = $pharmacy;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getContactRelationship()
    {
        return $this->contactRelationship;
    }

    /**
     * @param mixed $contactRelationship
     */
    public function setContactRelationship($contactRelationship)
    {
        $this->contactRelationship = $contactRelationship;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @param mixed $sex
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    }

    /**
     * @return mixed
     */
    public function getReferrer()
    {
        return $this->referrer;
    }

    /**
     * @param mixed $referrer
     */
    public function setReferrer($referrer)
    {
        $this->referrer = $referrer;
    }

    /**
     * @return mixed
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param mixed $provider
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
    }

    /**
     * @return mixed
     */
    public function getReferringProvider()
    {
        return $this->referringProvider;
    }

    /**
     * @param mixed $referringProvider
     */
    public function setReferringProvider($referringProvider)
    {
        $this->referringProvider = $referringProvider;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmailDirect()
    {
        return $this->emailDirect;
    }

    /**
     * @param mixed $emailDirect
     */
    public function setEmailDirect($emailDirect)
    {
        $this->emailDirect = $emailDirect;
    }

    /**
     * @return mixed
     */
    public function getEthnoracial()
    {
        return $this->ethnoracial;
    }

    /**
     * @param mixed $ethnoracial
     */
    public function setEthnoracial($ethnoracial)
    {
        $this->ethnoracial = $ethnoracial;
    }

    /**
     * @return mixed
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * @param mixed $race
     */
    public function setRace($race)
    {
        $this->race = $race;
    }

    /**
     * @return mixed
     */
    public function getEthnicity()
    {
        return $this->ethnicity;
    }

    /**
     * @param mixed $ethnicity
     */
    public function setEthnicity($ethnicity)
    {
        $this->ethnicity = $ethnicity;
    }

    /**
     * @return mixed
     */
    public function getReligion()
    {
        return $this->religion;
    }

    /**
     * @param mixed $religion
     */
    public function setReligion($religion)
    {
        $this->religion = $religion;
    }

    /**
     * @return mixed
     */
    public function getInterpretter()
    {
        return $this->interpretter;
    }

    /**
     * @param mixed $interpretter
     */
    public function setInterpretter($interpretter)
    {
        $this->interpretter = $interpretter;
    }

    /**
     * @return mixed
     */
    public function getMigrantSeasonal()
    {
        return $this->migrantSeasonal;
    }

    /**
     * @param mixed $migrantSeasonal
     */
    public function setMigrantSeasonal($migrantSeasonal)
    {
        $this->migrantSeasonal = $migrantSeasonal;
    }

    /**
     * @return mixed
     */
    public function getFamilySize()
    {
        return $this->familySize;
    }

    /**
     * @param mixed $familySize
     */
    public function setFamilySize($familySize)
    {
        $this->familySize = $familySize;
    }

    /**
     * @return mixed
     */
    public function getMonthlyIncome()
    {
        return $this->monthlyIncome;
    }

    /**
     * @param mixed $monthlyIncome
     */
    public function setMonthlyIncome($monthlyIncome)
    {
        $this->monthlyIncome = $monthlyIncome;
    }

    /**
     * @return mixed
     */
    public function getBillingNote()
    {
        return $this->billingNote;
    }

    /**
     * @param mixed $billingNote
     */
    public function setBillingNote($billingNote)
    {
        $this->billingNote = $billingNote;
    }

    /**
     * @return mixed
     */
    public function getHomeless()
    {
        return $this->homeless;
    }

    /**
     * @param mixed $homeless
     */
    public function setHomeless($homeless)
    {
        $this->homeless = $homeless;
    }

    /**
     * @return mixed
     */
    public function getFinancialReview()
    {
        return $this->financialReview;
    }

    /**
     * @param mixed $financialReview
     */
    public function setFinancialReview($financialReview)
    {
        $this->financialReview = $financialReview;
    }

    /**
     * @return mixed
     */
    public function getPubPid()
    {
        return $this->pubPid;
    }

    /**
     * @param mixed $pubPid
     */
    public function setPubPid($pubPid)
    {
        $this->pubPid = $pubPid;
    }

    /**
     * @return mixed
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * @param mixed $pid
     */
    public function setPid($pid)
    {
        $this->pid = $pid;
    }

    /**
     * @return mixed
     */
    public function getGenericName1()
    {
        return $this->genericName1;
    }

    /**
     * @param mixed $genericName1
     */
    public function setGenericName1($genericName1)
    {
        $this->genericName1 = $genericName1;
    }

    /**
     * @return mixed
     */
    public function getGenericValue1()
    {
        return $this->genericValue1;
    }

    /**
     * @param mixed $genericValue1
     */
    public function setGenericValue1($genericValue1)
    {
        $this->genericValue1 = $genericValue1;
    }

    /**
     * @return mixed
     */
    public function getGenericName2()
    {
        return $this->genericName2;
    }

    /**
     * @param mixed $genericName2
     */
    public function setGenericName2($genericName2)
    {
        $this->genericName2 = $genericName2;
    }

    /**
     * @return mixed
     */
    public function getGenericValue2()
    {
        return $this->genericValue2;
    }

    /**
     * @param mixed $genericValue2
     */
    public function setGenericValue2($genericValue2)
    {
        $this->genericValue2 = $genericValue2;
    }

    /**
     * @return mixed
     */
    public function getHipaaMail()
    {
        return $this->hipaaMail;
    }

    /**
     * @param mixed $hipaaMail
     */
    public function setHipaaMail($hipaaMail)
    {
        $this->hipaaMail = $hipaaMail;
    }

    /**
     * @return mixed
     */
    public function getHipaaVoice()
    {
        return $this->hipaaVoice;
    }

    /**
     * @param mixed $hipaaVoice
     */
    public function setHipaaVoice($hipaaVoice)
    {
        $this->hipaaVoice = $hipaaVoice;
    }

    /**
     * @return mixed
     */
    public function getHipaaNotice()
    {
        return $this->hipaaNotice;
    }

    /**
     * @param mixed $hipaaNotice
     */
    public function setHipaaNotice($hipaaNotice)
    {
        $this->hipaaNotice = $hipaaNotice;
    }

    /**
     * @return mixed
     */
    public function getHipaaMessage()
    {
        return $this->hipaaMessage;
    }

    /**
     * @param mixed $hipaaMessage
     */
    public function setHipaaMessage($hipaaMessage)
    {
        $this->hipaaMessage = $hipaaMessage;
    }

    /**
     * @return mixed
     */
    public function getHipaaSMS()
    {
        return $this->hipaaSMS;
    }

    /**
     * @param mixed $hipaaSMS
     */
    public function setHipaaSMS($hipaaSMS)
    {
        $this->hipaaSMS = $hipaaSMS;
    }

    /**
     * @return mixed
     */
    public function getHipaaEmail()
    {
        return $this->hipaaEmail;
    }

    /**
     * @param mixed $hipaaEmail
     */
    public function setHipaaEmail($hipaaEmail)
    {
        $this->hipaaEmail = $hipaaEmail;
    }

    /**
     * @return mixed
     */
    public function getSquad()
    {
        return $this->squad;
    }

    /**
     * @param mixed $squad
     */
    public function setSquad($squad)
    {
        $this->squad = $squad;
    }

    /**
     * @return mixed
     */
    public function getFitness()
    {
        return $this->fitness;
    }

    /**
     * @param mixed $fitness
     */
    public function setFitness($fitness)
    {
        $this->fitness = $fitness;
    }

    /**
     * @return mixed
     */
    public function getReferralSource()
    {
        return $this->referralSource;
    }

    /**
     * @param mixed $referralSource
     */
    public function setReferralSource($referralSource)
    {
        $this->referralSource = $referralSource;
    }

    /**
     * @return mixed
     */
    public function getUserText1()
    {
        return $this->userText1;
    }

    /**
     * @param mixed $userText1
     */
    public function setUserText1($userText1)
    {
        $this->userText1 = $userText1;
    }

    /**
     * @return mixed
     */
    public function getUserText2()
    {
        return $this->userText2;
    }

    /**
     * @param mixed $userText2
     */
    public function setUserText2($userText2)
    {
        $this->userText2 = $userText2;
    }

    /**
     * @return mixed
     */
    public function getUserText3()
    {
        return $this->userText3;
    }

    /**
     * @param mixed $userText3
     */
    public function setUserText3($userText3)
    {
        $this->userText3 = $userText3;
    }

    /**
     * @return mixed
     */
    public function getUserText4()
    {
        return $this->userText4;
    }

    /**
     * @param mixed $userText4
     */
    public function setUserText4($userText4)
    {
        $this->userText4 = $userText4;
    }

    /**
     * @return mixed
     */
    public function getUserText5()
    {
        return $this->userText5;
    }

    /**
     * @param mixed $userText5
     */
    public function setUserText5($userText5)
    {
        $this->userText5 = $userText5;
    }

    /**
     * @return mixed
     */
    public function getUserText6()
    {
        return $this->userText6;
    }

    /**
     * @param mixed $userText6
     */
    public function setUserText6($userText6)
    {
        $this->userText6 = $userText6;
    }

    /**
     * @return mixed
     */
    public function getUserText7()
    {
        return $this->userText7;
    }

    /**
     * @param mixed $userText7
     */
    public function setUserText7($userText7)
    {
        $this->userText7 = $userText7;
    }

    /**
     * @return mixed
     */
    public function getUserText8()
    {
        return $this->userText8;
    }

    /**
     * @param mixed $userText8
     */
    public function setUserText8($userText8)
    {
        $this->userText8 = $userText8;
    }

    /**
     * @return mixed
     */
    public function getUserList1()
    {
        return $this->userList1;
    }

    /**
     * @param mixed $userList1
     */
    public function setUserList1($userList1)
    {
        $this->userList1 = $userList1;
    }

    /**
     * @return mixed
     */
    public function getUserList2()
    {
        return $this->userList2;
    }

    /**
     * @param mixed $userList2
     */
    public function setUserList2($userList2)
    {
        $this->userList2 = $userList2;
    }

    /**
     * @return mixed
     */
    public function getUserList3()
    {
        return $this->userList3;
    }

    /**
     * @param mixed $userList3
     */
    public function setUserList3($userList3)
    {
        $this->userList3 = $userList3;
    }

    /**
     * @return mixed
     */
    public function getUserList4()
    {
        return $this->userList4;
    }

    /**
     * @param mixed $userList4
     */
    public function setUserList4($userList4)
    {
        $this->userList4 = $userList4;
    }

    /**
     * @return mixed
     */
    public function getUserList5()
    {
        return $this->userList5;
    }

    /**
     * @param mixed $userList5
     */
    public function setUserList5($userList5)
    {
        $this->userList5 = $userList5;
    }

    /**
     * @return mixed
     */
    public function getUserList6()
    {
        return $this->userList6;
    }

    /**
     * @param mixed $userList6
     */
    public function setUserList6($userList6)
    {
        $this->userList6 = $userList6;
    }

    /**
     * @return mixed
     */
    public function getUserList7()
    {
        return $this->userList7;
    }

    /**
     * @param mixed $userList7
     */
    public function setUserList7($userList7)
    {
        $this->userList7 = $userList7;
    }

    /**
     * @return mixed
     */
    public function getPriceLevel()
    {
        return $this->priceLevel;
    }

    /**
     * @param mixed $priceLevel
     */
    public function setPriceLevel($priceLevel)
    {
        $this->priceLevel = $priceLevel;
    }

    /**
     * @return mixed
     */
    public function getRegDate()
    {
        return $this->regDate;
    }

    /**
     * @param mixed $regDate
     */
    public function setRegDate($regDate)
    {
        $this->regDate = $regDate;
    }

    /**
     * @return mixed
     */
    public function getContraStart()
    {
        return $this->contraStart;
    }

    /**
     * @param mixed $contraStart
     */
    public function setContraStart($contraStart)
    {
        $this->contraStart = $contraStart;
    }

    /**
     * @return mixed
     */
    public function isAdCompleted()
    {
        return $this->completedAd;
    }

    /**
     * @param mixed $completedAd
     */
    public function setCompletedAd($completedAd)
    {
        $this->completedAd = $completedAd;
    }

    /**
     * @return mixed
     */
    public function getAdReviewed()
    {
        return $this->adReviewed;
    }

    /**
     * @param mixed $adReviewed
     */
    public function setAdReviewed($adReviewed)
    {
        $this->adReviewed = $adReviewed;
    }

    /**
     * @return mixed
     */
    public function getVfc()
    {
        return $this->vfc;
    }

    /**
     * @param mixed $vfc
     */
    public function setVfc($vfc)
    {
        $this->vfc = $vfc;
    }

    /**
     * @return mixed
     */
    public function getMotherName()
    {
        return $this->motherName;
    }

    /**
     * @param mixed $motherName
     */
    public function setMotherName($motherName)
    {
        $this->motherName = $motherName;
    }

    /**
     * @return mixed
     */
    public function getGuardianName()
    {
        return $this->guardianName;
    }

    /**
     * @param mixed $guardianName
     */
    public function setGuardianName($guardianName)
    {
        $this->guardianName = $guardianName;
    }

}
