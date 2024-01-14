<form class="col-3 mb-3" method="POST">
    <div class="mb-3">
        <label for="firstname" class="form-label">Vorname</label>
        <input type="text" class="form-control" name="firstname" id="firstname" <?php if(isset($_SESSION["currentUser"])) { echo "value=" . $_SESSION["currentUser"]->getName();} ?> readonly>
    </div>
    <div class="mb-3">
        <label for="lastname" class="form-label">Nachname</label>
        <input type="text" class="form-control" name="lastname" id="lastname" <?php if(isset($_SESSION["currentUser"])) { echo "value=" . $_SESSION["currentUser"]->getLastname();} ?> readonly>
    </div>    
    <div class="mb-3">
        <label for="start" class="form-label">Anreisetag</label>
        <input type="date" class="form-control <?php if(isset($startDateIsTodayOrLater) && !$startDateIsTodayOrLater) {echo "is-invalid";}?>" name="start" id="start" aria-describedby="startlHelp" <?php if(isset($_SESSION["currentReservation"]) && $_SESSION["currentReservation"]->getStartDate() != null) { echo "value=" . $_SESSION["currentReservation"]->getStartDateStringISO();} ?> required>
        <div id="startlHelp" class="form-text <?php if(isset($startDateIsTodayOrLater) && !$startDateIsTodayOrLater) {echo "text-danger";}?>"><?php if(isset($startDateIsTodayOrLater) && !$startDateIsTodayOrLater) { echo "Das Anreisedatum darf nicht in der Vergangenheit liegen!"; } ?></div>
    </div>
    <div class="mb-3">
        <label for="end" class="form-label">Abreisetag</label>
        <input type="date" class="form-control <?php if(isset($dateDiffIsPositive) && !$dateDiffIsPositive) {echo "is-invalid";}?>" name="end" id="end" aria-describedby="endHelp" <?php if(isset($_SESSION["currentReservation"]) && $_SESSION["currentReservation"]->getEndDate() != null) { echo "value=" . $_SESSION["currentReservation"]->getEndDateStringISO();} ?> required>
        <div id="endHelp" class="form-text <?php if(isset($dateDiffIsPositive) && !$dateDiffIsPositive) {echo "text-danger";}?>"><?php if(isset($dateDiffIsPositive) && !$dateDiffIsPositive) { echo "Das Abreisedatum darf nicht vor dem Anreisedatum liegen!"; } ?></div>
    </div>
    <div class="mb-3">
        <label for="numOfPers" class="form-label">Anzahl Personen</label>
        <input type="number" class="form-control" name="numOfPers" id="numOfPers" min="1" <?php if(isset($_SESSION["currentReservation"]) && $_SESSION["currentReservation"]->getNumOfPersons() >= 1) { echo "value=" . $_SESSION["currentReservation"]->getNumOfPersons();} ?> required>
    </div>       
    <button class="btn btn-primary" type="submit" name="goon" id="goon">Weiter</button>
</form>