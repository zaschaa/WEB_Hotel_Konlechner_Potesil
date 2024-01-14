<form class="col-3 mb-3" method="POST">
    <div class="mb-3">    
        <label for="roomType" class="form-label">Zu Ihrer Anfrage stehen folgende Zimmer-Kategorien zur Auswahl:</label>    
        <select name="roomType" id="roomType">
        <?php 
            foreach($_SESSION["availableRoomTypes"] as $rt) {
                if($_SESSION["roomType"]=== $rt) {
                    echo "<option selected value=\"$rt\">$rt</option>";
                } else {
                    echo "<option value=\"$rt\">$rt</option>";
                };                                
            }
        ?>         
        </select>
                        
    </div>
    <div class="mb-3">
        <label for="breakfast" class="form-label">Frühstück (falls gewünscht, bitte anhaken)</label> 
        <input type="checkbox" name="breakfast" id="breakfast" value="yes" aria-describedby="breakfastHelp" <?php if($_SESSION["currentReservation"]->hasBreakfast() === 1) { echo "checked=\"checked\"";} ?> > 
        <div id="breakfastHelp" class="form-text"><?php echo "Preis: " . number_format($rms->getChargedOptions()["breakfast"], 2, "," , ".") . "€ pro Pers. u. Nacht"; ?></div>
    </div>     
    <div class="mb-3">
        <label for="numOfParkLots" class="form-label">Anzahl Parkplätze</label>
        <input type="number" class="form-control" name="numOfParkLots" id="numOfParkLots" aria-describedby="parkingLotsHelp" <?php if($_SESSION["currentReservation"]->getNumOfParkingLots() != null) { echo "value=" . $_SESSION["currentReservation"]->getNumOfParkingLots();} else {echo "value=0";} ?> required>
        <div id="parkingLotsHelp" class="form-text"><?php echo "Preis: " . number_format($rms->getChargedOptions()["parking lot"], 2, "," , ".") . "€ pro Parkplatz u. Nacht"; ?></div>
    </div>
    <div class="mb-3">
        <label for="numOfPets" class="form-label">Anzahl Haustiere</label>
        <input type="number" class="form-control" name="numOfPets" id="numOfPets" aria-describedby="petsHelp" <?php if($_SESSION["currentReservation"]->getNumOfPets() != null) { echo "value=" . $_SESSION["currentReservation"]->getNumOfPets();} else {echo "value=0";} ?> required>
        <div id="petsHelp" class="form-text"><?php echo "Preis: " . number_format($rms->getChargedOptions()["pet"], 2, "," , ".") . "€ pro Haustier u. Nacht"; ?></div>
    </div>
    <label for="commentText" class="form-label">Sonstige Anmerkungen</label>    
    <div class="mb-3">        
        <textarea name="commentText" id="commentText" rows="7"><?php if(isset($_SESSION["currentReservation"])) { echo $_SESSION["currentReservation"]->getComment();} ?></textarea>
    </div>
    <div class="mb-3">    
        <button class="btn btn-danger" type="submit" name="goback" id="goback">Zurück</button>
        <button class="btn btn-primary" type="submit" name="goon2" id="goon2">Weiter zur Übersicht</button>     
    </div>
</form>