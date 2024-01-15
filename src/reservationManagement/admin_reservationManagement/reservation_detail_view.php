<table class="mb-2">
    <tr>
        <td class="resOVth">Vorname:</td>
        <td><?php echo $firstName; ?></td>            
    </tr>
    <tr>
        <td class="resOVth">Nachname:</td>
        <td><?php echo $lastName; ?></td>            
    </tr>
    <tr>
        <td class="resOVth">Zimmer-Kategorie:</td>
        <td><?php echo $roomTypeName; ?></td>            
    </tr>
    <tr>
        <td class="resOVth">Zimmer-Nummer:</td>
        <td><?php echo $roomNumber; ?></td>            
    </tr>    
    <tr>
        <td class="resOVth">Anreisetag:</td>
        <td><?php echo $res->getStartDateStringGerman(); ?></td>            
    </tr>
    <tr>
        <td class="resOVth">Abreisetag:</td>
        <td><?php echo $res->getEndDateStringGerman(); ?></td>            
    </tr>
    <tr>
        <td class="resOVth">Anzahl Nächte:</td>
        <td><?php echo $res->getNumOfNights(); ?></td>            
    </tr>
    <tr>
        <td class="resOVth">Anzahl Personen:</td>
        <td><?php echo $res->getNumOfPersons(); ?></td>            
    </tr>
    <tr>
        <td class="resOVth">Frühstück:</td>
        <td><?php echo $res->hasBreakfastYesOrNo(); ?></td>            
    </tr>
    <tr>
        <td class="resOVth">Anzahl Parkplätze:</td>
        <td><?php echo $res->getNumOfParkingLots(); ?></td>            
    </tr>
    <tr>
        <td class="resOVth">Anzahl Haustiere:</td>
        <td><?php echo $res->getNumOfPets(); ?></td>            
    </tr>
    <tr>
        <td class="resOVth">Sonstige Anmerkungen:</td>
        <td><?php echo $res->getComment(); ?></td>            
    </tr>
    <tr>
        <td class="resOVth">Preis Gesamt:</td>
        <td><?php echo $res->getTotalPrice(); ?> €</td>            
    </tr>
    <tr>
        <td class="resOVth">Status:</td>
        <td><?php echo $this->getResStateGerman($res->getState()); ?> </td>            
    </tr>            
</table>

<form class="mb-3" method="POST">
    <button class="btn btn-danger" type="submit" name="goback2ResList" id="goback2ResList">Zurück</button>
    <?php if($res->getState() != "cancelled"): ?>
         <button class="btn btn-warning" type="submit" name="cancelRes" id="cancelRes" value="<?php echo $resId; ?>">Stornieren</button>
    <?php endif; ?>
    <?php if($res->getState() === "new"): ?>
        <button class="btn btn-success" type="submit" name="confirmRes" id="confirmRes" value="<?php echo $resId; ?>">Bestätigen</button>
    <?php elseif($res->getState() === "cancelled"): ?>
        <button class="btn btn-success" type="submit" name="resetCancel" id="resetCancel" value="<?php echo $resId; ?>">Stornierung zurücksetzen</button>
    <?php endif; ?>    
</form>