<form class="col-3 mb-3" method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Vorname</label>
        <input type="text" class="form-control" name="name" id="name" <?php if(isset($_SESSION["currentUser"])) { echo "value=" . $_SESSION["currentUser"]->getName();} ?> readonly>
    </div>
    <div class="mb-3">
        <label for="lastname" class="form-label">Nachname</label>
        <input type="text" class="form-control" name="lastname" id="lastname" <?php if(isset($_SESSION["currentUser"])) { echo "value=" . $_SESSION["currentUser"]->getLastname();} ?> readonly>
    </div>
    <label for="roomType" class="form-label">Zimmer-Kategorie</label> 
    <div class="mb-3">               
        <select name="roomType" id="roomType">
            <?php if(!isset($_SESSION["roomType"])): ?>
                <option selected value="Deluxe Zimmer">Deluxe Zimmer</option>                                
                <option value="Junior Suite">Junior Suite</option>
                <option value="Signature Suite">Signature Suite</option>
                <option value="Grand Suite">Grand Suite</option>
            <?php else: ?>
                <option <?php if($_SESSION["roomType"]==="Deluxe Zimmer") {echo "selected";} ?> value="Deluxe Zimmer">Deluxe Zimmer</option>                                
                <option <?php if($_SESSION["roomType"]==="Junior Suite") {echo "selected";} ?> value="Junior Suite">Junior Suite</option>
                <option <?php if($_SESSION["roomType"]==="Signature Suite") {echo "selected";} ?> value="Signature Suite">Signature Suite</option> 
                <option <?php if($_SESSION["roomType"]==="Grand Suite") {echo "selected";} ?> value="Grand Suite">Grand Suite</option>           
            <?php endif;?>            
        </select>         
    </div>
    <div class="mb-3">
        <label for="start" class="form-label">Anreisetag</label>
        <input type="date" class="form-control" name="start" id="start" required>
    </div>
    <div class="mb-3">
        <label for="end" class="form-label">Abreisetag</label>
        <input type="date" class="form-control" name="end" id="end" required>
    </div>
    <div class="mb-3">
        <label for="numOfPers" class="form-label">Anzahl Personen</label>
        <input type="number" class="form-control" name="numOfPers" id="numOfPers" required>
    </div>   
    <div class="mb-3">
        <label for="breakfast" class="form-label">Frühstück</label>
        <input type="checkbox" name="breakfast" id="breakfast"> 
    </div>     
    <div class="mb-3">
        <label for="numOfParkLots" class="form-label">Anzahl Parkplätze</label>
        <input type="number" class="form-control" name="numOfParkLots" id="numOfParkLots" value=0 required>
    </div>
    <div class="mb-3">
        <label for="numOfPets" class="form-label">Anzahl Haustiere</label>
        <input type="number" class="form-control" name="numOfPets" id="numOfPets" value=0 required>
    </div>
    <label for="message" class="form-label">Anmerkungen</label>    
    <div class="mb-3">        
        <textarea name="message" id="message" rows="7"></textarea>
    </div>       
    <button class="btn btn-primary" type="submit" name="goon" id="goon">Weiter</button>
</form>