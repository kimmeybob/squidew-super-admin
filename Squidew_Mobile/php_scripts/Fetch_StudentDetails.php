<?php


$student_id = $_POST["student_id"];

//Test Data
//$student_id = '18000022';

require '../../Database Settings/database_access_credentials.php';

$query_fetch_student_data = " select student.*,
students_profile.student_id, students_profile.first_name,students_profile.middle_name,
students_profile.last_name, students_profile.suffix, students_profile.birthdate, students_profile.home_address, students_profile.contact_number as student_contact_number, students_profile.email,
students_profile.nationality, students_profile.sex,
hei.*,department.*,degree.* from student
inner join students_profile on students_profile.student_id = student.student_id
inner join hei on student.hei_id = hei.hei_id
inner join department on department.hei_id = hei.hei_id
inner join degree on degree.department_id = department.department_id
where student.student_id = '".$student_id."'";

$run_query = mysqli_query($connection, $query_fetch_student_data);
$query_fetch_response = mysqli_num_rows($run_query) > 0;

if($query_fetch_response){
    while($row = mysqli_fetch_assoc($run_query)){
        $jsonresult[] = $row;
    }

    print(json_encode($jsonresult));
}else{
    print("false");
}





?>