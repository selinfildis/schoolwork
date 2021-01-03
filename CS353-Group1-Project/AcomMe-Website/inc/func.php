<?php

function search($location, $startDate, $endDate, $guestNumber){
    global $db;
    
    $sql = "SELECT "
            . "O.offering_price, "
            . "A.accommodationID, "
            . "A.bed_number, "
            . "A.guest_number, "
            . "A.title, "
            . "A.rating, "
            . "O.offering_start_date, "
            . "O.offering_end_date "
	."FROM Offering O "
	."INNER JOIN Accommodation A "
		."ON O.offering_accommodationID = A.accommodationID "
	."INNER JOIN Accommodation_address AD "
		."ON A.accommodationID = AD.addrAccommodationID "
	."WHERE '$location' = AD.country OR '$location' = AD.city "
        ."AND O.offering_start_date <= '$startDate' "
        ."AND O.offering_end_date >= '$endDate' "
	."AND A.guest_number >= $guestNumber";
    
    $data = $db->prepare($sql);
    $data->execute();
    
    return $data->fetchAll(PDO::FETCH_OBJ);
    
}

function AdvanceSearch($location, $startDate, $endDate, $guestNumber,$isHave, $minPrice, $maxPrice){
    global $db;
    $sql = "SELECT "
            . "O.offering_price, "
            . "A.accommodationID, "
            . "A.bed_number, "
            . "A.guest_number, "
            . "A.title, "
            . "A.rating, "
            . "O.offering_start_date, "
            . "O.offering_end_date "
	."FROM Offering O "
	."INNER JOIN Accommodation A "
		."ON O.offering_accommodationID = A.accommodationID "
	."INNER JOIN Accommodation_address AD "
		."ON A.accommodationID = AD.addrAccommodationID "
        ."INNER JOIN Has_Amenity HA "
                . "ON A.accommodationID = HA.hasAcommodationID "
	."WHERE '$location' = AD.country OR '$location' = AD.city "
        ."AND O.offering_start_date <= '$startDate' "
        ."AND O.offering_end_date >= '$endDate' "
	."AND A.guest_number >= $guestNumber "
        ."AND HA.hasAmenityID IN(".implode(',',$isHave).") "
        ."AND O.offering_price <= $maxPrice "
        ."AND O.offering_price >= $minPrice "
        ."GROUP BY A.accommodationID, O.offeringID";
    $data = $db->prepare($sql);
    $data->execute();
    
    return $data->fetchAll(PDO::FETCH_OBJ);
}

function login($username, $password){
    global $db;
    
    $sql = "SELECT "
            . "U.userID, "
            . "U.username "
        . "FROM User U "
        . "INNER JOIN Login L "
            . "ON U.userID = loginUserID "
        . "WHERE U.username = '$username' "
        . "AND L.password = '$password' ";

    $data = $db->prepare($sql);
    $data->execute();
    
    $result = $data->fetchAll(PDO::FETCH_OBJ);
    if(count($result) >0 ){
        $return = current($result);
    }else{
        $return = false;
    }
    
    return $return;
}

function amenityList(){
    global $db;
    $sql = "SELECT * FROM Amenity;";
    $data = $db->prepare($sql);
    $data->execute();
    
    return $data->fetchAll(PDO::FETCH_OBJ);
}

