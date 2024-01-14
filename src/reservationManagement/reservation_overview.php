<h2>Übersicht</h2>

<table class="mb-2">
    <tr>
        <td class="resOVth">Vorname:</td>
        <td><?php echo $_SESSION["currentUser"]->getName(); ?></td>            
    </tr>
    <tr>
        <td class="resOVth">Nachname:</td>
        <td><?php echo $_SESSION["currentUser"]->getLastname(); ?></td>            
    </tr>
    <tr>
        <td class="resOVth">Zimmer-Kategorie:</td>
        <td><?php echo $_SESSION["currentReservation"]->getRoomType(); ?></td>            
    </tr>
    <tr>
        <td class="resOVth">Zimmer-Preis:</td>
        <td><?php echo number_format($rms->getRoomTypeInfo($_SESSION["currentReservation"]->getRoomType())->getPrice(), 2, "," , ".") . " € pro Pers. u. Nacht"; ?></td>            
    </tr>
    <tr>
        <td class="resOVth">Anreisetag:</td>
        <td><?php echo $_SESSION["currentReservation"]->getStartDateStringGerman(); ?></td>            
    </tr>
    <tr>
        <td class="resOVth">Abreisetag:</td>
        <td><?php echo $_SESSION["currentReservation"]->getEndDateStringGerman(); ?></td>            
    </tr>
    <tr>
        <td class="resOVth">Anzahl Nächte:</td>
        <td><?php echo $_SESSION["currentReservation"]->getNumOfNights(); ?></td>            
    </tr>
    <tr>
        <td class="resOVth">Anzahl Personen:</td>
        <td><?php echo $_SESSION["currentReservation"]->getNumOfPersons(); ?></td>            
    </tr>
    <tr>
        <td class="resOVth">Frühstück:</td>
        <td><?php echo $_SESSION["currentReservation"]->hasBreakfastYesOrNo(); ?></td>            
    </tr>
    <tr>
        <td class="resOVth">Anzahl Parkplätze:</td>
        <td><?php echo $_SESSION["currentReservation"]->getNumOfParkingLots(); ?></td>            
    </tr>
    <tr>
        <td class="resOVth">Anzahl Haustiere:</td>
        <td><?php echo $_SESSION["currentReservation"]->getNumOfPets(); ?></td>            
    </tr>
    <tr>
        <td class="resOVth">Sonstige Anmerkungen:</td>
        <td><?php echo $_SESSION["currentReservation"]->getComment(); ?></td>            
    </tr>
    <tr>
        <td class="resOVth">Preis Gesamt:</td>
        <td><?php echo $_SESSION["currentReservation"]->getTotalPrice(); ?> €</td>            
    </tr>            
</table>

<form class="mb-3" method="POST">
    <button class="btn btn-danger" type="submit" name="goback2" id="goback2">Zurück</button>
    <button class="btn btn-success" type="submit" name="confirmRes" id="confirmRes">Anfrage absenden</button>
</form>