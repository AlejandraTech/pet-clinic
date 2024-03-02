<?php
$petData = $content[0];
$ownerData = $content[1];
$historyData = $content[2];
?>

<div id="content">
    <h2>Pet</h2>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Owner's NIF</th>
                <th>Pet Name</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                if (isset($petData)) {
                    echo "<td>{$petData->getId()}</td>";
                    echo "<td>{$petData->getIdOwner()}</td>";
                    echo "<td>{$petData->getNames()}</td>";
                }
                ?>
            </tr>
        </tbody>
    </table>

    <h2>Pet's Owner</h2>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th>Nif</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                if (isset($ownerData)) {
                    echo "<td>{$ownerData->getNif()}</td>";
                    echo "<td>{$ownerData->getName()}</td>";
                    echo "<td>{$ownerData->getEmail()}</td>";
                    echo "<td>{$ownerData->getPhone()}</td>";
                }
                ?>
            </tr>
        </tbody>
    </table>

    <h2>Pet's History</h2>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th>Visit's ID</th>
                <th>Visit's Date</th>
                <th>Visit's motive</th>
                <th>Visit's description</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($historyData)) {
                foreach ($historyData as $element) {
                    echo "<tr>";
                    echo "<td>{$element->getId()}</td>";
                    echo "<td>{$element->getDate()}</td>";
                    echo "<td>{$element->getMotive()}</td>";
                    echo "<td>{$element->getDesc()}</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>