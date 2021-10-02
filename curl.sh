curl -X GET "localhost:8080/department"

curl -X POST "localhost:8080/department" -H 'Content-Type: application/json' -d'
{
  "building_location": "general",
  "workers": 1286
}
'

curl -X POST "localhost:8080/department/927" -H 'Content-Type: application/json' -d'
{
  "building_location": "general",
  "department_id": 927,
  "workers": 1286
}
'

curl -X GET "localhost:8080/department/927"

curl -X DELETE "localhost:8080/department/927"

# --

curl -X GET "localhost:8080/worker"

curl -X POST "localhost:8080/worker" -H 'Content-Type: application/json' -d'
{
  "first_name": "until",
  "gender": "thing",
  "last_name": "particular",
  "salary": 421.1432,
  "telephone": "bed"
}
'

curl -X POST "localhost:8080/worker/8380" -H 'Content-Type: application/json' -d'
{
  "first_name": "until",
  "gender": "thing",
  "last_name": "particular",
  "salary": 421.1432,
  "telephone": "bed",
  "worker_id": 8380
}
'

curl -X GET "localhost:8080/worker/8380"

curl -X DELETE "localhost:8080/worker/8380"

# --

curl -X GET "localhost:8080/doctor"

curl -X POST "localhost:8080/doctor" -H 'Content-Type: application/json' -d'
{
  "degree": "herself",
  "department_id": "person",
  "field": "strong",
  "worker_id": 6238
}
'

curl -X POST "localhost:8080/doctor/6614" -H 'Content-Type: application/json' -d'
{
  "degree": "herself",
  "department_id": "person",
  "doctor_id": 6614,
  "field": "strong",
  "worker_id": 6238
}
'

curl -X GET "localhost:8080/doctor/6614"

curl -X DELETE "localhost:8080/doctor/6614"

# --

curl -X GET "localhost:8080/staff"

curl -X POST "localhost:8080/staff" -H 'Content-Type: application/json' -d'
{
  "job_title": "travel",
  "worker_id": 5641
}
'

curl -X POST "localhost:8080/staff/8369" -H 'Content-Type: application/json' -d'
{
  "job_title": "travel",
  "staff_id": 8369,
  "worker_id": 5641
}
'

curl -X GET "localhost:8080/staff/8369"

curl -X DELETE "localhost:8080/staff/8369"

# --

curl -X GET "localhost:8080/cafeteria"

curl -X POST "localhost:8080/cafeteria" -H 'Content-Type: application/json' -d'
{
  "food_type": "Republican",
  "seating": 4096
}
'

curl -X POST "localhost:8080/cafeteria/6743" -H 'Content-Type: application/json' -d'
{
  "cafeteria_id": 6743,
  "food_type": "Republican",
  "seating": 4096
}
'

curl -X GET "localhost:8080/cafeteria/6743"

curl -X DELETE "localhost:8080/cafeteria/6743"

# --

curl -X GET "localhost:8080/cafeteria-staff"

curl -X POST "localhost:8080/cafeteria-staff" -H 'Content-Type: application/json' -d'
{
  "cafeteria_id": "check",
  "position": "know",
  "staff_id": 2376
}
'

curl -X POST "localhost:8080/cafeteria-staff/2989" -H 'Content-Type: application/json' -d'
{
  "cafeteria_id": "check",
  "cafetria_staff_id": 2989,
  "position": "know",
  "staff_id": 2376
}
'

curl -X GET "localhost:8080/cafeteria-staff/2989"

curl -X DELETE "localhost:8080/cafeteria-staff/2989"

# --

curl -X GET "localhost:8080/bill"

curl -X POST "localhost:8080/bill" -H 'Content-Type: application/json' -d'
{
  "prescription": "arrive",
  "tests": "argue",
  "time_admitted": "2021-09-29",
  "treatment": "arm"
}
'

curl -X POST "localhost:8080/bill/1068" -H 'Content-Type: application/json' -d'
{
  "bill_id": 1068,
  "prescription": "arrive",
  "tests": "argue",
  "time_admitted": "2021-09-29",
  "treatment": "arm"
}
'

curl -X GET "localhost:8080/bill/1068"

curl -X DELETE "localhost:8080/bill/1068"

# --

curl -X GET "localhost:8080/patient"

curl -X POST "localhost:8080/patient" -H 'Content-Type: application/json' -d'
{
  "address": "Father natural simple light sure. Police reflect game hope majority campaign.",
  "age": 3165,
  "bill_id": 3966,
  "blood_type": "hold",
  "cafeteria_id": "popular",
  "first_name": "the",
  "gender": "important",
  "last_name": "local",
  "telephone": "forward"
}
'

curl -X POST "localhost:8080/patient/7937" -H 'Content-Type: application/json' -d'
{
  "address": "Father natural simple light sure. Police reflect game hope majority campaign.",
  "age": 3165,
  "bill_id": 3966,
  "blood_type": "hold",
  "cafeteria_id": "popular",
  "first_name": "the",
  "gender": "important",
  "last_name": "local",
  "patient_id": 7937,
  "telephone": "forward"
}
'

curl -X GET "localhost:8080/patient/7937"

curl -X DELETE "localhost:8080/patient/7937"

# --

curl -X GET "localhost:8080/medication"

curl -X POST "localhost:8080/medication" -H 'Content-Type: application/json' -d'
{
  "doses": 1498,
  "expiration_date": "2021-10-05"
}
'

curl -X POST "localhost:8080/medication/3552" -H 'Content-Type: application/json' -d'
{
  "doses": 1498,
  "expiration_date": "2021-10-05",
  "medication_id": 3552
}
'

curl -X GET "localhost:8080/medication/3552"

curl -X DELETE "localhost:8080/medication/3552"

# --

curl -X GET "localhost:8080/medication-prescribed"

curl -X POST "localhost:8080/medication-prescribed" -H 'Content-Type: application/json' -d'
{
  "medication_id": "watch",
  "patient_id": 8738,
  "prescription_id": 59
}
'

curl -X POST "localhost:8080/medication-prescribed/5913" -H 'Content-Type: application/json' -d'
{
  "medication_id": "watch",
  "medication_prescribed_id": 5913,
  "patient_id": 8738,
  "prescription_id": 59
}
'

curl -X GET "localhost:8080/medication-prescribed/5913"

curl -X DELETE "localhost:8080/medication-prescribed/5913"

# --

curl -X GET "localhost:8080/diagnosis"

curl -X POST "localhost:8080/diagnosis" -H 'Content-Type: application/json' -d'
{
  "doctor_id": 9697,
  "illness": "assume",
  "patient_id": 5876
}
'

curl -X POST "localhost:8080/diagnosis/3976" -H 'Content-Type: application/json' -d'
{
  "diagnosis_id": 3976,
  "doctor_id": 9697,
  "illness": "assume",
  "patient_id": 5876
}
'

curl -X GET "localhost:8080/diagnosis/3976"

curl -X DELETE "localhost:8080/diagnosis/3976"

# --

curl -X GET "localhost:8080/tests"

curl -X POST "localhost:8080/tests" -H 'Content-Type: application/json' -d'
{
  "doctor_id": 6432,
  "illness": "local",
  "patient_id": 629,
  "result": 8064
}
'

curl -X POST "localhost:8080/tests/309" -H 'Content-Type: application/json' -d'
{
  "doctor_id": 6432,
  "illness": "local",
  "patient_id": 629,
  "result": 8064,
  "test_id": 309
}
'

curl -X GET "localhost:8080/tests/309"

curl -X DELETE "localhost:8080/tests/309"

# --

curl -X GET "localhost:8080/doctor-patient"

curl -X POST "localhost:8080/doctor-patient" -H 'Content-Type: application/json' -d'
{
  "doctor_id": 5975,
  "examination_date": "2021-10-14",
  "patient_id": 769
}
'

curl -X POST "localhost:8080/doctor-patient/1070" -H 'Content-Type: application/json' -d'
{
  "doctor_id": 5975,
  "doctor_patient_id": 1070,
  "examination_date": "2021-10-14",
  "patient_id": 769
}
'

curl -X GET "localhost:8080/doctor-patient/1070"

curl -X DELETE "localhost:8080/doctor-patient/1070"

# --

