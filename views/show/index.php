<h1><?= _('Beitr�ge, die mir gefallen') ?></h1>

<table class="default">
    <caption>
        <?= _('�bersicht') ?>
    </caption>
    <thead>
        <tr>
            <th>Autor</th>
            <th>Anzahl Beitr�ge</th>
        </tr>
    </thead>
    <tbody>
    <? foreach($overview as $entry) : ?>
        <tr>
            <td><?= get_fullname($entry['user_id']) ?></td>
            <td><?= $entry['ges'] ?></td>
        </tr>
    <? endforeach ?>
    <tbody>
</table>

<table class="default">
    <caption>
        <?= _('Beitragsliste') ?>
    </caption>
    <thead>
        <tr>
            <th>Autor</th>
            <th>Beitrag</th>
        </tr>
    </thead>
    <tbody>
    <? foreach($entries as $entry) : ?>
        <tr>
            <td><?= get_fullname($entry['user_id']) ?></td>
            <? $description = ForumEntry::killFormat(ForumEntry::killEdit($entry['content'])) ?>
            <td><?= htmlReady(substr($description, 0, 150)) ?>
        </tr>
    <? endforeach ?>
    <tbody>
</table>
