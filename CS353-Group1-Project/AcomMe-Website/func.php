<?php
$fileUpload = new FileUpload();
function search($location, $startDate, $endDate, $guestNumber){
    global $db;
    
    $sql = "SELECT "
            . "O.offering_price, "
            . "O.offeringID, "
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
	."AND A.guest_number >= $guestNumber "
        ."GROUP BY O.offeringID";
    
    $data = $db->prepare($sql);
    $data->execute();
    
    return $data->fetchAll(PDO::FETCH_OBJ);
    
}

function AdvanceSearch($location, $startDate, $endDate, $guestNumber,$isHave, $minPrice, $maxPrice){
    global $db;
    $sql = "SELECT "
            . "O.offering_price,"
            . "O.offeringID, "
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
	."AND A.guest_number >= $guestNumber ";
    
    if(count($isHave) > 0){
        $sql .= "AND HA.hasAmenityID IN(".implode(',',$isHave).") ";
    }
    if($maxPrice > 0){
        $sql .= "AND O.offering_price <= $maxPrice ";
    }
    if($minPrice > 0){
        $sql .="AND O.offering_price >= $minPrice ";
    }
        $sql .= "GROUP BY O.offeringID";

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

function register($data, $files=null){
    global $db;
    global $fileUpload;
    $birthDate = $data['year'].'-'.$data['month'].'-'.$data['day'];
    
    
    $sql = "INSERT INTO User (userName, name, surname, birthDate, email, gender, short_bio) VALUES (?,?,?,?,?,?,?)";
    $query = $db->prepare($sql);
    $insert = $query->execute(array($data['userName'], $data['name'],  $data['surname'], $birthDate, $data['email'], $data['gender'], $data['short_bio']));
    
    $userID = $db->lastInsertId();
    
    $sql = "INSERT INTO User_address (addrUserID, country, city, district, street, building_number, postcode) VALUES (?,?,?,?,?,?,?)";
    $query = $db->prepare($sql);
    $insert = $query->execute(array($userID, $data['country'], $data['city'],  $data['district'],  $data['street'], $data['building_number'], $data['postcode']));
    
    $sql = "INSERT INTO Phone (phoneUserID, phone_number) VALUES (?,?)";
    $query = $db->prepare($sql);
    $insert = $query->execute(array($userID, $data['phone_number']));
    
    $sql = "INSERT INTO Login (loginUserID, password) VALUES (?,?)";
    $query = $db->prepare($sql);
    $insert = $query->execute(array($userID, md5($data['password'])));
    
    if($files['profilePicture']['tmp_name'] != 0){
        if($fileUpload->uploadItem('profile', $userID.'.jpg', $files['profilePicture']['tmp_name']) != false){
            profilePictureUpdate($userID);
        }
    }

}

function amenityList(){
    global $db;
    $sql = "SELECT * FROM Amenity;";
    $data = $db->prepare($sql);
    $data->execute();
    
    return $data->fetchAll(PDO::FETCH_OBJ);
}

function getUserInfo($userID){
    global $db;
    
    $sql = "SELECT * FROM `User` WHERE `userID` = ".$userID;
    $data = $db->prepare($sql);
    $data->execute();
    
    return current($data->fetchAll(PDO::FETCH_OBJ));
}

function getUserAdress($userID){
    global $db;
    
    $sql = "SELECT * FROM `User_address` WHERE `addrUserID` = ".$userID;
    $data = $db->prepare($sql);
    $data->execute();
    
    return current($data->fetchAll(PDO::FETCH_OBJ));
}

function getUserPhone($userID){
    global $db;
    
    $sql = "SELECT * FROM `Phone` WHERE `phoneUserID` = ".$userID;
    $data = $db->prepare($sql);
    $data->execute();
    
    return current($data->fetchAll(PDO::FETCH_OBJ));
}

function emailCheck($email){
    global $db;
    
    $sql = "SELECT * FROM `User` WHERE `email` = '".$email."'";
    $data = $db->prepare($sql);
    $data->execute();
    $count = count($data->fetchAll(PDO::FETCH_OBJ));
    
    if($count > 0){
        return false;
    }else{
        return true;
    }
    
}

function userNameCheck($username){
    global $db;
    
    $sql = "SELECT * FROM `User` WHERE `userName` = '".$username."'";
    $data = $db->prepare($sql);
    $data->execute();
    $count = count($data->fetchAll(PDO::FETCH_OBJ));
    
    if($count > 0){
        return false;
    }else{
        return true;
    }
    
}

function passwordUpdate($userID,$password){
    global $db;
    
    $sql = "UPDATE `Login` SET `password`= '".$password."' WHERE `loginUserID` = $userID";
    $query = $db->prepare($sql);
    $query->execute();
}

function profileUpdate($userID,$data){
    global $db;
    $birthDate = $data['year'].'-'.$data['month'].'-'.$data['day'];
    $sql = "UPDATE `User` SET "
            . "`name`='".$data['name']."', "
            . "`surname`='".$data['surname']."', "
            . "`birthDate`='".$birthDate."',"
            . "`email`= '".$data['email']."', "
            . "`short_bio` = '".$data['short_bio']."' "
            . "WHERE `userID`= $userID";
    
    $query = $db->prepare($sql);
    $query->execute();
    
    $sql = "UPDATE `User_address` SET "
            . "`country`='".$data['country']."', "
            . "`city`='".$data['city']."', "
            . "`district`= '".$data['district']."', "
            . "`street` = '".$data['street']."', "
            . "`building_number` = '".$data['building_number']."', "
            . "`postcode` = '".$data['postcode']."' "
            . "WHERE `addrUserID`= $userID";
 
    $query = $db->prepare($sql);
    $query->execute();
    
}

function profilePictureUpdate($userID){
    global $db;
    
    $sql = "UPDATE `User` SET "
            . "`photo`='".$userID.".jpg' " 
            . "WHERE `UserID`= $userID";
 
    $query = $db->prepare($sql);
    $query->execute();
}

function getHouseInfo($offeringID){
    global $db;
    
    $sql = "SELECT * "
            ."FROM Offering O "
            ."INNER JOIN Accommodation A "
		."ON O.offering_accommodationID = A.accommodationID "
            ."WHERE O.offeringID = $offeringID;";
    $data = $db->prepare($sql);
    $data->execute();
    
    return current($data->fetchAll(PDO::FETCH_OBJ));
    
}

function getHouseData($AccommodationID){
    global $db;
    $sql = "SELECT * "
            ."FROM Accommodation A "
            ."INNER JOIN Accommodation_address AO "
            . "ON A.accommodationID = AO.addrAccommodationID "
            ."INNER JOIN Offering O "
		."ON AO.addrAccommodationID = O.offering_accommodationID "
            ."WHERE A.accommodationID = $AccommodationID;";
    $data = $db->prepare($sql);
    $data->execute();
    
    return current($data->fetchAll(PDO::FETCH_OBJ));
    
}

function getHousePhoto($accommodationID){
    global $db;
    
    $sql = "SELECT * "
            ."FROM Photo "
            ."WHERE photoAccommodationID = $accommodationID";
    $data = $db->prepare($sql);
    $data->execute();
    
    return $data->fetchAll(PDO::FETCH_OBJ);
}

function makeReservation($userID,$data){
    global $db;
    $reservationDate = explode(' - ',$data['DateRanges']);
    $sql = "INSERT INTO Reservation (reservationGuestID, reservationOfferingID, reservation_start_date, reservation_end_date, reservation_price) VALUES (?,?,?,?,?)";
    $query = $db->prepare($sql);
    $insert = $query->execute(array($userID, $data['offeringID'],  $reservationDate[0], $reservationDate[1], $data['offeringPrice']));
    
}

function getMyReservation($userID){
    global $db;
    
    $sql = "SELECT * FROM Reservation R "
            . "INNER JOIN Offering O "
                . "ON R.reservationOfferingID = O.offeringID "
            . "INNER JOIN Accommodation A "
                . "ON O.offering_accommodationID = A.accommodationID "
            . "INNER JOIN User U "
                . "ON A.host_ID = U.userID "
            . "WHERE R.reservationGuestID = ".$userID;
    $data = $db->prepare($sql);
    $data->execute();
    
    return $data->fetchAll(PDO::FETCH_OBJ);
}

function discardReservation($reservationID){
    global $db;
    
    $sql = "SELECT * "
            ."FROM Reservation"
            ."WHERE reservationID = $reservationID;";
    $data = $db->prepare($sql);
    $data->execute();
    $result = $data->fetchAll(PDO::FETCH_OBJ);
    if($result > 0){
        $sql = "DELETE FROM Reservation WHERE `reservationID`=".$reservationID;
        $data = $db->prepare($sql);
        $data->execute();
    }
}

function approveReservation($reservationID){
    global $db;
    
    $sql = "UPDATE Reservation SET confirmed = 1 WHERE reservationID = ".$reservationID;
    $query = $db->prepare($sql);
    $query->execute();
}

function reservationRequestView($userID){
    global $db;
    $sql = "SELECT * FROM Accommodation A "
            . "INNER JOIN Offering O "
                . "ON A.accommodationID = O.offering_accommodationID "
            . "INNER JOIN Reservation R "
                . "ON O.offeringID = R.reservationOfferingID "
            . "INNER JOIN User U "
                . "ON R.reservationGuestID = U.userID "
            . "WHERE A.host_ID = ".$userID;
    
    $data = $db->prepare($sql);
    $data->execute();
    
    return $data->fetchAll(PDO::FETCH_OBJ);
}

function userHouses($userID){
    global $db;
    $sql = "SELECT * FROM Accommodation A "
            . "INNER JOIN Accommodation_address AD "
                . "ON A.accommodationID = AD.addrAccommodationID "
            . "WHERE A.host_ID = ".$userID;
    $data = $db->prepare($sql);
    $data->execute();
    return $data->fetchAll(PDO::FETCH_OBJ);
}

function registerHouse($userID, $data, $files){
    global $db;
    global $fileUpload;
    $date = explode(' - ',$data['DateRange']);

    
    
    $sql = "INSERT INTO Accommodation (	host_ID, title, bed_number, guest_number, bath_number, description) VALUES (?,?,?,?,?,?)";
    $query = $db->prepare($sql);
    $insert = $query->execute(array($userID,  $data['title'], $data['bed_number'], $data['guest_number'], $data['bath_number'], $data['description']));
    
    $houseID = $db->lastInsertId();
    
    $sql = "INSERT INTO Accommodation_address (addrAccommodationID, country, city, district, street, building_number, postcode) VALUES (?,?,?,?,?,?,?)";
    $query = $db->prepare($sql);
    $insert = $query->execute(array($houseID, $data['country'], $data['city'],  $data['district'],  $data['street'], $data['building_number'], $data['postcode']));
    
    if(count($data['isHave'])>0){
        foreach($data['isHave'] as $key=>$value){
            $sql = "INSERT INTO Has_Amenity (hasAcommodationID, hasAmenityID) VALUES (?,?)";
            $query = $db->prepare($sql);
            $insert = $query->execute(array($houseID, $value));
        }
    }
    
    
    $sql = "INSERT INTO Offering (offering_accommodationID, offering_price, offering_start_date, offering_end_date) VALUES (?,?,?,?)";
    $query = $db->prepare($sql);
    $insert = $query->execute(array($houseID, $data['offering_price'], $date[0], $date[1]));
    
    
    if($files['housePhotos']['error'][0] != 4){

            foreach($files['housePhotos']['tmp_name'] as $key=>$value){
                $fileName = uniqid(rand(), true).'.jpg';
                $uploadCheck = $fileUpload->uploadItem('house', $fileName, $value);
                if($uploadCheck != false){
                    $sql = "INSERT INTO Photo (photoAccommodationID, photo) VALUES (?,?)";
                    $query = $db->prepare($sql);
                    $insert = $query->execute(array($houseID, $fileName));
                }
            }
        
    }
}

function updateHouse($accommodationID, $data, $files){
    global $db;
    global $fileUpload;
    $date = explode(' - ',$data['DateRange']);
    
    $sql = "UPDATE Accommodation  SET title = ?, bed_number = ?, guest_number = ?, bath_number = ?, description = ? WHERE accommodationID = ?";
    $query = $db->prepare($sql);
    $insert = $query->execute(array($data['title'], $data['bed_number'], $data['guest_number'], $data['bath_number'], $data['description'], $accommodationID));
    
    $sql = "UPDATE Accommodation_address SET country = ?, city = ?, district = ?, street = ?, building_number = ?, postcode = ? WHERE addrAccommodationID = ?";
    $query = $db->prepare($sql);
    $insert = $query->execute(array( $data['country'], $data['city'],  $data['district'],  $data['street'], $data['building_number'], $data['postcode'], $accommodationID));

    if(count($data['isHave'])>0){
        $sql = "DELETE FROM `Has_Amenity` WHERE `hasAcommodationID` = ".$accommodationID;
        $dataDelete = $db->prepare($sql);
        $dataDelete->execute();
        
        foreach($data['isHave'] as $key=>$value){
            $sql = "INSERT INTO Has_Amenity (hasAcommodationID, hasAmenityID) VALUES (?,?)";
            $query = $db->prepare($sql);
            $insert = $query->execute(array($accommodationID, $value));
        }
    }
    
    $sql = "UPDATE Offering  SET offering_price = ?, offering_start_date = ?, offering_end_date = ? WHERE offering_accommodationID = ?";
    $query = $db->prepare($sql);
    $insert = $query->execute(array($data['offering_price'], $date[0], $date[1], $accommodationID));
    
    if($files['housePhotos']['error'][0] != 4){

            foreach($files['housePhotos']['tmp_name'] as $key=>$value){
               
                $fileName = uniqid(rand(), true).'.jpg';
                $uploadCheck = $fileUpload->uploadItem('house', $fileName, $value);
                if($uploadCheck != false){
                    $sql = "INSERT INTO Photo (photoAccommodationID, photo) VALUES (?,?)";
                    $query = $db->prepare($sql);
                    $insert = $query->execute(array($accommodationID, $fileName));
                }
            }
        
    }
    
}

function houseAmenity($acommodationID){
    global $db;
    
    $return = array();
    
    $sql = "SELECT * FROM Has_Amenity WHERE `hasAcommodationID` = ".$acommodationID;
    $data = $db->prepare($sql);
    $data->execute();
    foreach($data->fetchAll(PDO::FETCH_OBJ) as $data){
        $return[] = $data->hasAmenityID;
    }
    
    return $return;
}

function addWish($userID, $acommodationID){
    global $db;
    
    $sql = "INSERT INTO Wishes (wishesGuestID, wishesAccommodationID) VALUES (?,?)";
    $query = $db->prepare($sql);
    $insert = $query->execute(array($userID, $acommodationID));
    
}

function userWishes($userID){
    global $db;
    
    $sql = "SELECT * FROM Wishes WHERE `wishesGuestID` = ".$userID;
    $data = $db->prepare($sql);
    $data->execute();
    
    return $data->fetchAll(PDO::FETCH_OBJ);
}

function deleteWish($userID, $acommodationID){
    global $db;
    
    $sql = "DELETE FROM Wishes WHERE `wishesGuestID` = ".$userID." AND wishesAccommodationID = ".$acommodationID;
    $data = $db->prepare($sql);
    $data->execute();
    
    return $data->fetchAll(PDO::FETCH_OBJ);
}

function sendMessage($userID,$recevieID,$title,$body){
    global $db;
    
    $sql = "INSERT INTO Message (message_title, message_body, date) VALUES (?,?,?)";
    $query = $db->prepare($sql);
    $insert = $query->execute(array($title, $body, date('Y-m-d')));
    
    $messageID = $db->lastInsertId();
    
    $sql = "INSERT INTO User_message (message_ID, sendID, receiveID) VALUES (?,?,?)";
    $query = $db->prepare($sql);
    $insert = $query->execute(array($messageID, $userID, $recevieID));
    
    
}

function getMessage($messageID){
    global $db;
    
    $sql = "SELECT * FROM User_message UM "
            . "INNER JOIN Message M "
            . "ON UM.message_ID = M.messageID "
            . "WHERE UM.message_ID = ".$messageID;
    $data = $db->prepare($sql);
    $data->execute();
    
    return current($data->fetchAll(PDO::FETCH_OBJ));
}

function getUserInbox($userID){
    global $db;
    
    $sql = "SELECT * FROM User_message UM "
            . "INNER JOIN Message M "
            . "ON UM.message_ID = M.messageID "
            . "WHERE UM.receiveID = ".$userID;
    
    $data = $db->prepare($sql);
    $data->execute();
    
    return $data->fetchAll(PDO::FETCH_OBJ);
}

function getUserData($userID){
    global $db;
    
    $sql = "SELECT * FROM User WHERE `userID` = ".$userID;
    $data = $db->prepare($sql);
    $data->execute();
    
    return current($data->fetchAll(PDO::FETCH_OBJ));
}

function deleteMessage($messageID){
    global $db;
    
    $sql = "DELETE FROM Message WHERE `messageID` = ".$messageID;
    $data = $db->prepare($sql);
    $data->execute();
    
    $sql = "DELETE FROM User_message WHERE `message_ID` = ".$messageID;
    $data = $db->prepare($sql);
    $data->execute();
    
   
}