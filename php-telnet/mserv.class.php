<?php
require_once "telnet.class.php";
class MServ {
	// thies@thieso.net 2001

	var $error_result = "[] Command not understood";

	var $tn_con    = NULL;
	var $tn_host   = NULL;
	var $tn_port   = NULL;
	var $tn_user   = NULL;
	var $tn_pass   = NULL;

	function MServ($host,$port,$user,$pass) {
	        $this->tn_host   = $host;
	        $this->tn_port   = $port;
	        $this->tn_user   = $user;
	        $this->tn_pass   = $pass;
	}	

        function isServeronline() {
          $fh = fsockopen($this->tn_host,$this->tn_port);
          if (!$fh) {
            return false;
          }
          fclose($fh);
          return true;
        }


        function close() {
                if ($this->tn_con) {
                        $this->tn_con->close();
                        $this->sock = NULL;
	        }
	}

        function connect() {
                $this->tn_con     = new telnet($this->tn_host,$this->tn_port);
                $write_result = $this->tn_con->read_till("\r\n.");
                $this->tn_con->write("USER " . $this->tn_user . "\r\n");
                $write_result =  $this->tn_con->read_till("\r\n.");
                $this->tn_con->write("PASS " . $this->tn_pass . " COMPUTER\r\n");
                $write_result = $this->tn_con->read_till(".");
        }
        function getInfo() {
                $this->connect();
                // echo "connected <br>";
                $this->tn_con->write("INFO\r\n");
                $this->tn_con->write("error\r\n");
                // echo "wrote info and error <br>";
                $info_result = $this->tn_con->read_till($this->error_result);
                eregi("\[\]([^[]+)", $info_result, $return_res);
                $this->close();
                return $return_res[1];
        }        
        function getAlbumList($separation_string) {
                $this->connect();
                // echo "connected <br>";
                $this->tn_con->write("ALBUMS\r\n");
                $this->tn_con->write("error\r\n");
                // echo "wrote info and error <br>";
                $albums_result = $this->tn_con->read_till($this->error_result);
                $albums_result = str_replace ($this->error_result, "", $albums_result);
                $albums_result = str_replace ("\r\n", $separation_string, $albums_result);
//                $albums_result = str_replace ("[]", "", $albums_result);
                $this->close();
//                echo $albums_result;
                return $albums_result;
        }        
        function getTrackList($album_nr, $separation_string) {
                $this->connect();
                // echo "connected <br>";
                $this->tn_con->write("TRACKS " . $album_nr . "\r\n");
                $this->tn_con->write("error\r\n");
                // echo "wrote info and error <br>";
                $tracks_result = $this->tn_con->read_till($this->error_result);
                $tracks_result = str_replace ($this->error_result, "", $tracks_result);
                $tracks_result = str_replace ("\r\n", $separation_string, $tracks_result);
                $tracks_result = str_replace ("[]", "", $tracks_result);
                $this->close();
                return $tracks_result;
        }        
        
        function Rate($album_nr, $track_nr, $rating) {
                
                // Keep Track Nr. empty if you want to rate the whole album
                // Keep Album and Track Nr. empty if you want to rate the current song.
                
                $this->connect();
                // echo "connected <br>";
                $this->tn_con->write("RATE " . $album_nr . " " . $track_nr . " " . $rating . "\r\n");
        }        
        function Queue($album_nr, $track_nr, $p_random = "") {
                
                // Keep Track Nr. empty if you want to rate the whole album
                // Keep Album and Track Nr. empty if you want to rate the current song.
                
                $this->connect();
                // echo "connected <br>";
                $s = "QUEUE " . $album_nr . " " . $track_nr;
                if ($p_random == "1") {
                  $s .= " RANDOM ";
                }
                $this->tn_con->write($s . "\r\n");
        }        
        function getLevels() {
                $this->connect();
                // echo "connected <br>";
                $this->tn_con->write("VOLUME\r\n");
                $this->tn_con->write("TREBLE\r\n");
                $this->tn_con->write("BASS\r\n");
                $this->tn_con->write("error\r\n");
                // echo "wrote info and error <br>";
                $levels_result = $this->tn_con->read_till($this->error_result);
                eregi("Volume is currently ([0-9]+)%", $levels_result, $regexp_res);
                $res_array['vol'] = $regexp_res[1];
                eregi("Bass level is currently ([0-9]+)%", $levels_result, $regexp_res);
                $res_array['bas'] = $regexp_res[1];
                eregi("Treble level is currently ([0-9]+)%", $levels_result, $regexp_res);
                $res_array['tre'] = $regexp_res[1];
                return $res_array;
        }        
        function setVolume($p_value) {
                $this->connect();
                // echo "connected <br>";
                $this->tn_con->write("VOLUME " . $p_value . "\r\n");
        }        
        function setBass($p_value) {
                $this->connect();
                // echo "connected <br>";
                $this->tn_con->write("BASS " . $p_value . "\r\n");
        }        
        function setTreble($p_value) {
                $this->connect();
                // echo "connected <br>";
                $this->tn_con->write("TREBLE " . $p_value . "\r\n");
        }        

        function getInfo($album_nr, $track_nr, $separation_string) {
                
                // Keep Track Nr. empty to get info about the whole album
                // Keep Album and Track Nr. empty to get info about the current song
                
                $this->connect();
                // echo "connected <br>";
                $this->tn_con->write("INFO $album_nr $track_nr \r\n");
                $this->tn_con->write("error\r\n");
                // echo "wrote info and error <br>";
                $info_result = $this->tn_con->read_till($this->error_result);
                $info_result = str_replace ($this->error_result, "", $info_result);
                $info_result = str_replace ("\r\n", $separation_string, $info_result);
                $info_result = str_replace ("[]", "", $info_result);
                $this->close();
                return $info_result;
        }        
        function PlayControl($p_value) {
                $this->connect();
                // echo "connected <br>";
                $this->tn_con->write($p_value . "\r\n");
        }        
}

?>