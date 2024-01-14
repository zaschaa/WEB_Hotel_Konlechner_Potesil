<h2>Übersicht</h2>

<table class="mb-2">
    <tr>
        <th class="resOVth">Vorname:</th>
        <th><?php echo $_SESSION["currentUser"]->getName(); ?></th>            
    </tr>
    <tr>
        <th class="resOVth">Nachname:</th>
        <th><?php echo $_SESSION["currentUser"]->getLastname(); ?></th>            
    </tr>
    <tr>
        <th class="resOVth">Zimmer-Kategorie:</th>
        <th><?php echo $_SESSION["currentReservation"]->getRoomType(); ?></th>            
    </tr>
    <tr>
        <th class="resOVth">Zimmer-Preis:</th>
        <th><?php echo number_format($rms->getRoomTypeInfo($_SESSION["currentReservation"]->getRoomType())->getPrice(), 2, "," , ".") . " € pro Pers. u. Nacht"; ?></th>            
    </tr>
    <tr>
        <th class="resOVth">Anreisetag:</th>
        <th><?php echo $_SESSION["currentReservation"]->getStartDateStringGerman(); ?></th>            
    </tr>
    <tr>
        <th class="resOVth">Abreisetag:</th>
        <th><?php echo $_SESSION["currentReservation"]->getEndDateStringGerman(); ?></th>            
    </tr>
    <tr>
        <th class="resOVth">Anzahl Nächte:</th>
        <th><?php echo $_SESSION["currentReservation"]->getNumOfNights(); ?></th>            
    </tr>
    <tr>
        <th class="resOVth">Anzahl Personen:</th>
        <th><?php echo $_SESSION["currentReservation"]->getNumOfPersons(); ?></th>            
    </tr>
    <tr>
        <th class="resOVth">Frühstück:</th>
        <th><?php echo $_SESSION["currentReservation"]->hasBreakfastYesOrNo(); ?></th>            
    </tr>
    <tr>
        <th class="resOVth">Anzahl Parkplätze:</th>
        <th><?php echo $_SESSION["currentReservation"]->getNumOfParkingLots(); ?></th>            
    </tr>
    <tr>
        <th class="resOVth">Anzahl Haustiere:</th>
        <th><?php echo $_SESSION["currentReservation"]->getNumOfPets(); ?></th>            
    </tr>
    <tr>
        <th class="resOVth">Sonstige Anmerkungen:</th>
        <th><?php echo $_SESSION["currentReservation"]->getComment(); ?></th>            
    </tr>
    <tr>
        <th class="resOVth">Preis Gesamt:</th>
        <th><?php echo $_SESSION["currentReservation"]->getTotalPrice(); ?> €</th>            
    </tr>            
</table>

<form class="mb-3" method="POST">
    <button class="btn btn-danger" type="submit" name="goback2" id="goback2">Zurück</button>
    <button class="btn btn-success" type="submit" name="confirmRes" id="confirmRes">Anfrage absenden</button>
</form>