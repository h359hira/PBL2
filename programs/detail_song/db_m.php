<?php

//実際は曲詳細画面から取得
$spotify_id = '7iN1s7xHE4ifF5povM6A48';
//実際は他画面から取得
$subject_user_id = 'john1234';

class GetReview{
    
    //PDOインスタンス
    private $dsn = 'mysql:dbname=pbl2;host=localhost';
    private $user = 'root';
    private $password = '';

    public function get_all_track_review($sp_id){
        try{
            $dbh = new PDO($this->dsn, $this->user, $this->password);
            $sql = "SELECT * FROM track_evaluation_table WHERE spotify_id = :spotify_id";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(":spotify_id", $sp_id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e){
            print('Error:'.$e->getMessage());
            die();
        }
        return $result;
    }

    public function get_all_user_review($sub_user_id){
        try{
            $dbh = new PDO($this->dsn, $this->user, $this->password);
            $sql = "SELECT * FROM user_evaluation_table WHERE subject_user_id = :subject_user_id";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(":subject_user_id", $sub_user_id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e){
            print('Error:'.$e->getMessage());
            die();
        }
        return $result;
    }
}

//この下の処理を他画面で呼び出す。
$db_review = new GetReview();
$res1 = $db_review->get_all_track_review($spotify_id);
$res2 = $db_review->get_all_user_review($subject_user_id);
var_dump($res1);
var_dump($res2);
?>