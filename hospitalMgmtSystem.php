<!-- Design a Hospital Management System using PHP and Object-Oriented Programming (OOP) principles.
It should manage doctors, patients, and appointments. Create classes for Doctor, Patient, and Appointment with
appropriate properties and methods. Implement a base class Person for common properties like name and age, and derive
Doctor and Patient from it. Ensure encapsulation by making sensitive properties private and accessing them via gettersand setters. Add a constructor to initialize objects. Use inheritance to create an EmergencyAppointment class extending Appointment, and override its methods for custom behavior. Implement polymorphism by defining a Billable interface with a generateBill() method, implemented in both Appointment and EmergencyAppointment. Use static members in the Appointment class to track total appointments, and manage invalid operations with exception handling. Test the system by booking appointments, checking doctor availability, generating bills, and handling errors like fully booked slots or invalid
appointment dates. -->

<?php

// Base class Person
class Person
{
    protected $name;
    protected $age;

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }
}

// Derived class Doctor
class Doctor extends Person
{
    private $specialization;

    public function __construct($name, $age, $specialization)
    {
        parent::__construct($name, $age);
        $this->specialization = $specialization;
    }

    public function getSpecialization()
    {
        return $this->specialization;
    }
}

// Derived class Patient
class Patient extends Person
{
    private $patientId;

    public function __construct($name, $age, $patientId)
    {
        parent::__construct($name, $age);
        $this->patientId = $patientId;
    }

    public function getPatientId()
    {
        return $this->patientId;
    }
}

// Billable interface
interface Billable
{
    public function generateBill();
}

// Appointment class
class Appointment implements Billable
{
    private static $totalAppointments = 0;
    protected $doctor;
    protected $patient;
    protected $date;

    public function __construct(Doctor $doctor, Patient $patient, $date)
    {
        if (new DateTime($date) < new DateTime()) {
            throw new Exception("Invalid appointment date. Date cannot be in the past.");
        }
        $this->doctor = $doctor;
        $this->patient = $patient;
        $this->date = $date;
        self::$totalAppointments++;
    }

    public static function getTotalAppointments()
    {
        return self::$totalAppointments;
    }

    public function getDoctor()
    {
        return $this->doctor;
    }

    public function getPatient()
    {
        return $this->patient;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function generateBill()
    {
        return "Appointment bill generated for patient: " . $this->patient->getName();
    }
}

// EmergencyAppointment class
class EmergencyAppointment extends Appointment
{
    private $priorityLevel;

    public function __construct(Doctor $doctor, Patient $patient, $date, $priorityLevel)
    {
        parent::__construct($doctor, $patient, $date);
        $this->priorityLevel = $priorityLevel;
    }

    public function getPriorityLevel()
    {
        return $this->priorityLevel;
    }

    public function generateBill()
    {
        return "Emergency appointment bill with priority level {$this->priorityLevel} for patient: " . $this->patient->getName();
    }
}

// Test the system
try {
    $doctor1 = new Doctor("Dr. Stark", 45, "Cardiology");
    $patient1 = new Patient("John Doe", 30, "P123");

    $appointment1 = new Appointment($doctor1, $patient1, "2025-01-20");
    echo $appointment1->generateBill() . "<br>";

    $emergencyAppointment = new EmergencyAppointment($doctor1, $patient1, "2025-01-19", "High");
    echo $emergencyAppointment->generateBill() . "<br>";

    echo "Total Appointments: " . Appointment::getTotalAppointments() . "<br>";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}

?>