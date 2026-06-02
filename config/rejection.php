<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Default Rejection Letter
    |--------------------------------------------------------------------------
    |
    | Bilingual (Hungarian + English) letter used when a volunteer or ministry
    | team application is rejected. The :name placeholder is replaced with the
    | applicant's first name. This text pre-fills the reject action's reason
    | field in the admin and is the fallback body of the rejection email.
    |
    */

    'default' => <<<'LETTER'
Kedves :name!

Köszönjük, hogy jelentkeztél önkéntes szolgálatra a rendezvényünkre, és hogy szíveden viseled ezt az alkalmat.

A rendelkezésre álló helyek korlátozott száma miatt sajnos ezúttal nem tudjuk elfogadni a jelentkezésedet a szolgálói csapatba.

Ennek ellenére szeretettel és örömmel várunk magára a rendezvényre résztvevőként! Hisszük, hogy Isten különleges módon fog munkálkodni az alkalmon, és örülünk, hogy velünk leszel.

Köszönjük a megértésedet, és reméljük, hogy a jövőben lesz még lehetőség együtt szolgálni.

Áldással és szeretettel,
Europe Revival Szervezők

---

Dear :name,

Thank you for applying to serve as a volunteer at our event and for carrying this occasion in your heart.

Due to the limited number of available positions, we are unfortunately unable to accept your application for the ministry team at this time.

Nevertheless, we would be delighted to welcome you to the event as a participant! We believe that God will move in a special way during this gathering, and we are truly glad that you will be with us.

Thank you for your understanding, and we hope there will be opportunities to serve together in the future.

With blessings and love,
Europe Revival Organizers
LETTER,
];
