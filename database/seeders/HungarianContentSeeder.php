<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\ScheduleItem;
use App\Models\Speaker;
use App\Models\Workshop;
use Illuminate\Database\Seeder;

/**
 * Seeds Hungarian translations into the `translations` JSON column on
 * speakers, workshops, schedule items, and FAQs. Source: client's
 * Fordítás_Honlap.docx and Vízió_Europe Revival 2026.docx.
 *
 * Untranslated fields fall back to the English column at render time.
 */
class HungarianContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedSpeakers();
        $this->seedWorkshops();
        $this->seedScheduleItems();
        $this->seedFaqs();
    }

    private function setHu(string $modelClass, string $slugColumn, array $entries): void
    {
        foreach ($entries as $key => $hu) {
            $model = $modelClass::query()->where($slugColumn, $key)->first();
            if (! $model) {
                continue;
            }
            $translations = $model->translations ?? [];
            $translations['hu'] = array_filter(
                array_merge($translations['hu'] ?? [], $hu),
                fn ($v) => $v !== null && $v !== '',
            );
            $model->translations = $translations;
            $model->save();
        }
    }

    private function seedSpeakers(): void
    {
        $this->setHu(Speaker::class, 'slug', [
            'mel-tari' => [
                'title' => 'Evangelista',
                'organization' => '„Like a Mighty Wind” c. könyv szerzője',
                'bio' => 'Az indonéz születésű Mel Tari – akit sokan csak Papa Melnek hívnak – egy valódi hadvezér a hitben. Papa Mel Isten küldöttje, tele szenvedéllyel. A nemzetek felé szolgál, tömegeket küld ki az aratás mezejére, lángra lobbantva az ébredés tüzét azáltal, hogy megerősít, pártfogol, isteni kapcsolatokat teremt és építi Krisztus testét. Rendszeres előadója nyári táborainknak a 2021-es kezdetek óta. Papa Mel a „Like a Mighty Wind” c. könyv szerzője, amely világszerte milliókra volt hatással.',
            ],
            'heidi-baker' => [
                'title' => 'Misszionárius',
                'organization' => 'Iris Global társalapítója',
                'bio' => 'Heidi legnagyobb szenvedélye, hogy Isten kézzelfogható jelenlétében éljen, hogy bemutassa az Ő dicsőségét, jelenlétét és szeretetét mind a Krisztus Testében, mind a haldokló világban. Rolland és Heidi Baker 1980-ban alapították az Iris Ministries-t, amely ma Iris Global néven ismert. 1995-ben a világ akkori legszegényebb országába, Mozambikba kaptak elhívást, ahol komoly próbatételekkel szembesültek. Elhagyott utcagyerekek felé kezdtek odaadóan szolgálni, és ahogy a Szent Szellem csodálatosan megnyilvánult rajtuk keresztül, az ébredés elterjedt Mozambik mind a tíz tartományába. Heidi – akit ezrek ma már csak Mama Heidiként ismernek – egy széleskörű szolgálatot vezet, amelyhez bibliaiskolák, kórházak, árvaellátás és egy többezer gyülekezetet magába foglaló gyülekezethálózat tartozik.',
            ],
            'ben-fitzgerald' => [
                'title' => 'Evangélista, Pásztor',
                'organization' => 'Awakening Gyülekezet pásztora',
                'bio' => "Ben Fitzgerald szenvedélyesen szereti Jézust! Az Awakening Europe mozgalom valamint az Awakening gyülekezetek vezetője. Ez a mozgalom egész Európában hirdeti az evangéliumot stadion rendezvényeken, városi evangelizációkon és iskolákban. Ben Ausztráliából származik, Melbourne városából. 2002-ben egy nagyon nehéz időszakában egy személyes találkozása volt Jézussal, ami teljesen megváltoztatta az életét. Azóta egy dolog hajtja: hogy bemutassa Jézust az embereknek és elvigye a Királyság örömhírét a nemzetekhez.\n\nŐ és csapata abban segítenek, hogy az emberek felkészüljenek az evangélium megosztására, új gyülekezeteket indítsanak és Európában egy tiszta szívű, imádó nemzedék nőjön fel.\n\nA Biblia a Galata 5:1-ben így fogalmaz: „a szabadságban, amire minket Krisztus megszabadított, álljatok meg és ne kötelezzétek meg ismét magatokat szolgaságnak igájával!” Ben szívügye, hogy segítsen az embereknek Isten szabadságában és az Istentől kapott identitásuk teljességében élni. Mélyen hiszi, hogy a nemzetek jövője olyan elkötelezett hívők által formálódik, akik szabadon élnek és bátran beszélnek Jézusról.",
            ],
            'david-gava' => [
                'title' => 'Misszionárius',
                'organization' => 'Kerusso társalapítója',
                'bio' => 'David eredetileg Zimbabwéből származik, jelenleg Svédországban él feleségével, Ingelával és két gyermekükkel. Misszionárius és a Kerusso Ministry alapítója Svédországban, valamint a Kerusso School alapítója Brazíliában, amelyet családjával együtt vezet. Több, mint két évtizede hirdeti a feltámadást és osztja meg az emberekkel erőteljes bizonyságát arról, hogy Isten meggyógyította őt egy súlyos beszédhibából, amely 21 éves koráig ellehetetlenítette számára a nyilvános beszédet. Azóta élő bizonyítéka annak, hogy Istennel semmi sem lehetetlen. Szolgáló szívű vezető, aki alázattal és szelídséggel, a Királytól kapott bölcsességgel bátorítja és vezeti az ébredésért elkötelezett embereket a világ különböző nemzeteiben.',
            ],
            'mary-pat-gokee' => [
                'bio' => 'Mary Pat Gokee férjével együtt a Frontline Ministries International alapítói és vezető szolgálói, amely missziós, tanítási és lelki ébredést célzó munkát végez világszerte. Aktívan szolgál prédikátorként, tanítóként és missziós vezetőként az FMI keretein belül. Férjével együtt vezetik a Frontline Worship Center nevű gyülekezetet. A szolgálata kiterjed nemzetközi csapatmissziókra, gyülekezetalapításra, lelki ébredés elindítására szerte a világon. Emellett teret ad gyógyító alkalmaknak, képzéseknek és hitben növekedni vágyó hívők mentorálásának.',
            ],
            'baoyan-lam' => [
                'bio' => "Lam Baoyan és Rudy Taslim misszionáriusok és építészek, a Living Oaks és a Genesis Architects alapítói, akik Szingapúrban élnek, de világszerte szolgálnak. Erős háttérrel rendelkeznek az építészet, az üzleti élet és a gazdasági szféra területén, és emellett elkötelezettek abban, hogy bemutassák: a szakmai kiválóság és Isten Királyságának értékei együtt képesek nemzeteket formálni és megváltoztatni.\n\nMunkájukban a tervezést, a stratégiai gondolkodást és a társadalmi felelősségvállalást ötvözik, hogy fenntartható megoldásokat hozzanak létre nehéz, válság sújtotta és háborús területeken is.\n\nHelyi gyülekezetekkel és vezetőkkel együttműködve kutakat, iskolákat, menedékhelyeket és közösségi épületeket hoznak létre, különösen olyan régiókban, ahol háború vagy kényszer elvándorlás zajlik. Emellett szívügyük a szegények és kiszolgáltatott emberek segítése, mert hisznek abban, hogy a valódi változás egyszerre kell, hogy rendszerszintű és szeretetteljes legyen.\n\nNemzetközileg elismertek humanitárius építészeti munkájukért, valamint azért, ahogyan összekapcsolják az üzleti világot és a missziót – gyakorlati módon hozva reményt, méltóságot és helyreállítást a rászoruló közösségekbe.",
            ],
            'katey-maddux' => [
                'bio' => 'Katey Maddux Isten királyságának építője, aki elkötelezte magát, hogy segítsen a nőknek szabadságban, tisztán látásban, bátor engedelmességben élni és felfedezni Isten életükre és családjukra vonatkozó tervét. A Kingdom Business Collective alapítója, ami egy keresztény női vállalkozói és vezetői közösség, valamint alapítója a Mighty Warrior International nonprofit szervezetnek, ami az emberkereskedelem és a kizsákmányolás elleni küzdelem megelőzésére, a tudatosság növelésére és megoldási stratégiákra összpontosít. Munkája az üzleti élet, a szolgálat és a globális misszióra terjed ki, partneri kapcsolatokkal szerte a világon: Egyesült Államokban, Európában, Afrikában és Ázsiában.',
            ],
            'tineke-bouwman' => [
                'bio' => 'Tineke Bouwman egy úttörő, és a Lighthouse Ministries alapítója a hollandiai Rillandban. Egy prófétai hang a mai generáció számára, aki áttörést hoz és tüzet gyújt azok szívében, akik felé szolgál. Felszabadítja az embereket arra, hogy belépjenek az elhívásukba. A Lighthouse egy olyan szolgálat, ami az Istentől kapott prófétai kinyilatkoztatásból született. Ez egy Családi Otthon (fiatalok számára egy lakóközösség), egy imaház, egy gyülekezet és egy oktatási központ. Ami egy egyszerű igennel kezdődött, mára pedig már prófétai mozgalommá nőtte ki magát. Tineke egy olyan Jézusért égő generációt nevelt fel, ami megérti az Istennel való bensőséges kapcsolat értékét. Nemzetközi szinten dolgozik vezetők tanácsadójaként és oktatójaként. Amikor éppen nem a nemzetek felé szolgál, akkor öt gyermek (köztük egy nevelt lány) édesanyjaként és nyolc unoka nagymamájaként nagyon hálás, hogy élvezheti a családja társaságát.',
            ],
            'brian-valerie' => [
                'bio' => "Brian Britton a Harvest Family Network alapítója és vezetője, amelynek világszerte vannak tagjai. Virginiában hosszú éveken át lelkipásztorként szolgált egy ébredési légkörű gyülekezetben, emellett több mint 24 éve szolgál misszionáriusként, evangélistaként és vendégelőadóként. Nemzetközi szolgálatokban is részt vesz az IRIS Global szervezet munkáján keresztül, amelyet Heidi és Rolland Baker misszionáriusok alapítottak, valamint több nonprofit szervezet vezetésében is szerepet vállal. Feleségével, Valerie-vel együtt a Regent University-n szerzett gyakorlati teológiai mesterdiplomát és jelenleg Williamsburgban (USA) élnek.\n\nValerie Britton prófétai és tanítói területen szolgál. Az Egyesült Államokban valamint nemzetközileg is szolgál vendégelőadóként. Üzenetének középpontjában az Atya szeretete áll, és arra bátorítja a hívőket, hogy valóban Isten gyermekeiként éljenek.",
            ],
            'dr-kate' => [
                'bio' => "Dr. Kate Hartman 1994-ben egy életét megváltoztató álomban kapta küldetését az Úr Jézustól, és több mint 25 éve felszentelt szolgálóként teljes idejű szolgálatban áll. Több megszerzett doktori fokozattal rendelkezik. Dr. Hartman keresztény egyetemet és otthontanulást támogató programot alapított, férjével, Greggel együtt pedig több gyülekezetet plántáltak és pásztoroltak.\n\nDr. Hartman számos apostoli vezetői csapatban szolgált országos és nemzetközi szinten – vezetőket képezve imádságban, belső gyógyulásban, dicsőítő táncban, evangelizációban, tanítványozásban, oktatásban és közösségfejlesztésben. Tapasztalt előadó pásztori konferenciákon és ébredési alkalmakon, és vándorszolgálata, a Life Spirit Fire Ministries keretein belül messiási rendezvényeket szervez, öt kontinensen érintve közösségeket.",
            ],
        ]);
    }

    private function seedWorkshops(): void
    {
        $this->setHu(Workshop::class, 'slug', [
            'power-evangelism' => [
                'title' => 'Evangélizáció hatalommal - David Gava',
                'short_description' => 'Tanuld meg, hogyan lépj ki bátran, és hirdesd az evangéliumot úgy, hogy jelek és csodák kísérjék.',
                'description' => 'Nem csak beszéd, hanem erő. Amikor az evangélium megelevenedik: Isten jelenléte gyógyít, szabadít és természetfeletti áttörést hoz.',
            ],
            'revival-harvest' => [
                'title' => 'Ébredés és aratás - David Gava',
                'short_description' => 'Evangelizáció a Szent Szellem erejével.',
                'description' => "Szenvedélyesen vágysz arra, hogy lásd az elveszettek megtérését, a Szent Szellem tüzétől lángra lobbanva?\n\nEljött az idő az aratásra – készülj fel rá!\n\nA Szent Szellem kész arra, hogy az életedet teljesen átformálja, hogy az életed többé ne hétköznapi legyen, hanem az Isten Királyságának az ereje formálja át minden területen.",
            ],
            'missions' => [
                'title' => 'Szenvedély, Cél, Tűz - Mary Pat Gokee',
                'short_description' => 'Kapj víziót a globális misszióra, és tanulj meg gyakorlati lépéseket, hogyan válaszolj az elhívásra.',
                'description' => "Szeretnél több iránymutatást és célt találni az életedben? Szeretnél nagyobb szenvedéllyel élni Istenért? Szeretnéd komolyabban követni Jézust? Szeretnél mélyebb kapcsolatba kerülni a Szent Szellemmel? Ha igen, akkor ez az előadás neked szól.\n\nTanuld meg, hogyan élj sértődés nélküli életet és járj megbocsátásban. Ismerd meg, hogyan állj helyt a lelki harcokban és győzz Isten gyermekeként. Az evangelizáció cselekvő útján kezdesz elindulni, és kulcsokat kapsz arra, hogyan láss másokat természetfeletti módon meggyógyulni és szabadulni. Megtapasztalod, milyen egy együttérző, küldetésben élő élet a mindennapokban.\n\nArra lettél teremtve, hogy teljes szívedből szeresd Istent, és segíts másokat is erre vezetni. Csatlakozz hozzánk a frontvonalon!",
            ],
            'missions-sunday' => [
                'title' => 'Szenvedély, Cél, Tűz - Mary Pat Gokee',
                'short_description' => 'Kapj víziót a globális misszióra, és tanulj meg gyakorlati lépéseket, hogyan válaszolj az elhívásra.',
                'description' => "Szeretnél több iránymutatást és célt találni az életedben? Szeretnél nagyobb szenvedéllyel élni Istenért? Szeretnéd komolyabban követni Jézust? Szeretnél mélyebb kapcsolatba kerülni a Szent Szellemmel? Ha igen, akkor ez az előadás neked szól.\n\nTanuld meg, hogyan élj sértődés nélküli életet és járj megbocsátásban. Ismerd meg, hogyan állj helyt a lelki harcokban és győzz Isten gyermekeként. Az evangelizáció cselekvő útján kezdesz elindulni, és kulcsokat kapsz arra, hogyan láss másokat természetfeletti módon meggyógyulni és szabadulni. Megtapasztalod, milyen egy együttérző, küldetésben élő élet a mindennapokban.\n\nArra lettél teremtve, hogy teljes szívedből szeresd Istent, és segíts másokat is erre vezetni. Csatlakozz hozzánk a frontvonalon!",
            ],
            'marketplace-missions' => [
                'title' => 'Üzleti misszió - Baoyan Lam & Rudy Taslim',
                'short_description' => 'Alakítsd át a munkahelyedet missziós területté, és integráld a hitet az üzleti életbe.',
                'description' => "Lam és Rudy Taslim tapasztalt üzleti múlttal rendelkező vezetők, akik világszerte indítottak humanitárius, fejlesztési és üzleti projekteket. Bár egy kis országból származnak, megtapasztalták, hogy Isten Királyságának elvei nem a mérettől függenek – képesek életeket és közösségeket megváltoztatni: újjáépíteni városokat, helyreállítani emberi méltóságot, és reményt hozni a világ legkülönbözőbb pontjaira, emberek ezreinek életét érintve.\n\nÉzsaiás 61 látására építve egyetlen küldetés vezérli őket: építeni, megújítani és helyreállítani. Valós, megrázó és inspiráló történeteken keresztül – háborús övezetekből, nehéz sorsú közösségekből és globális kezdeményezésekből – megmutatják, hogyan válhat a munkád, a befolyásod és az erőforrásaid valódi változást hozó eszközzé.\n\nEz az alkalom segít meglátni, hogyan tud Isten használni a vállalkozásban, innovációban és vezetésben, hogy kapukat nyisson, kultúrát formáljon és életeket változtasson meg.\n\nEz nem csak egy előadás. Ez egy meghívás egy életmódra: hogy céllal élj, hogy a munkahelyed oltár legyen, a munkád istentisztelet, és az életed része legyen annak a nagyobb tervnek, amellyel Isten gyógyulást, szabadságot és helyreállítást hoz a világba.\n\nHa valaha is érezted, hogy a munkád több lehet ennél – akkor ezt az alkalmat nem érdemes kihagynod.",
            ],
            'marketplace-missions-sunday' => [
                'title' => 'Üzleti misszió - Baoyan Lam & Rudy Taslim',
                'short_description' => 'Alakítsd át a munkahelyedet missziós területté, és integráld a hitet az üzleti életbe.',
                'description' => "Lam és Rudy Taslim tapasztalt üzleti múlttal rendelkező vezetők, akik világszerte indítottak humanitárius, fejlesztési és üzleti projekteket. Bár egy kis országból származnak, megtapasztalták, hogy Isten Királyságának elvei nem a mérettől függenek – képesek életeket és közösségeket megváltoztatni: újjáépíteni városokat, helyreállítani emberi méltóságot, és reményt hozni a világ legkülönbözőbb pontjaira, emberek ezreinek életét érintve.\n\nÉzsaiás 61 látására építve egyetlen küldetés vezérli őket: építeni, megújítani és helyreállítani. Valós, megrázó és inspiráló történeteken keresztül – háborús övezetekből, nehéz sorsú közösségekből és globális kezdeményezésekből – megmutatják, hogyan válhat a munkád, a befolyásod és az erőforrásaid valódi változást hozó eszközzé.\n\nEz az alkalom segít meglátni, hogyan tud Isten használni a vállalkozásban, innovációban és vezetésben, hogy kapukat nyisson, kultúrát formáljon és életeket változtasson meg.\n\nEz nem csak egy előadás. Ez egy meghívás egy életmódra: hogy céllal élj, hogy a munkahelyed oltár legyen, a munkád istentisztelet, és az életed része legyen annak a nagyobb tervnek, amellyel Isten gyógyulást, szabadságot és helyreállítást hoz a világba.\n\nHa valaha is érezted, hogy a munkád több lehet ennél – akkor ezt az alkalmat nem érdemes kihagynod.",
            ],
            'human-trafficking-awareness' => [
                'title' => 'Emberkereskedelem elleni küzdelem - Katey Maddux',
                'short_description' => 'Tudatosság, megelőzés és stratégiai megoldások a kizsákmányolás elleni harcban.',
                'description' => "Az emberkereskedelem egy nagyon összetett probléma, amire nincs egy gyors megoldás. Olyan jelenség, amihez tisztánlátásra, alázatra és kitartásra van szükség.\n\nSokan úgy gondolják, hogy az emberkereskedelem az csak elrabolt emberekről szól, a legtöbb esetben azonban csalásról, félelemről és manipulációról van szó. Gyakran a mindennapi életünkben észrevétlenül történik.\n\nEzen az előadásban Katey Maddux saját nemzetközi tapasztalatai alapján mutatja be, hogyan lehet ezen a területen segíteni. Beszél arról, milyen nehéz dolgozni különböző országokban és és miért fontos a hosszú távú jelenlét, a bizalom kiépítése és az együttműködés másokkal.\n\nSzó lesz arról is, hogy ebben a munkában nagyon fontos a bölcsesség, az alázat és a kitartás – különösen akkor, amikor bonyolultak a helyzetek, és az eredmények nem jönnek gyorsan.\n\nEz az alkalom azoknak szól, akik szeretnének segíteni az emberkereskedelem megelőzésében, felszámolásában, az áldozatok támogatásában vagy akár imában és együttműködésben.\n\nHa úgy érzed, hogy egy nehéz és fontos területre hív az Isten, ahol nem mindig látszik azonnal az eredmény, de mégis kitartóan jelen kell lenni, akkor ez az előadás neked szól.\n\nHa úgy érzed, hogy ott kell építened, ahol nincs kész út, bölcsességgel kell helytállnod a nehéz helyzetekben, és egy nálad nagyobb ügyet kell hűséggel hordoznod, ez az alkalom segít, hogy tisztánlátással és erővel tudj elindulni.",
            ],
            'human-trafficking-awareness-sunday' => [
                'title' => 'Emberkereskedelem elleni küzdelem - Katey Maddux',
                'short_description' => 'Tudatosság, megelőzés és stratégiai megoldások a kizsákmányolás elleni harcban.',
                'description' => "Az emberkereskedelem egy nagyon összetett probléma, amire nincs egy gyors megoldás. Olyan jelenség, amihez tisztánlátásra, alázatra és kitartásra van szükség.\n\nSokan úgy gondolják, hogy az emberkereskedelem az csak elrabolt emberekről szól, a legtöbb esetben azonban csalásról, félelemről és manipulációról van szó. Gyakran a mindennapi életünkben észrevétlenül történik.\n\nEzen az előadásban Katey Maddux saját nemzetközi tapasztalatai alapján mutatja be, hogyan lehet ezen a területen segíteni. Beszél arról, milyen nehéz dolgozni különböző országokban és és miért fontos a hosszú távú jelenlét, a bizalom kiépítése és az együttműködés másokkal.\n\nSzó lesz arról is, hogy ebben a munkában nagyon fontos a bölcsesség, az alázat és a kitartás – különösen akkor, amikor bonyolultak a helyzetek, és az eredmények nem jönnek gyorsan.\n\nEz az alkalom azoknak szól, akik szeretnének segíteni az emberkereskedelem megelőzésében, felszámolásában, az áldozatok támogatásában vagy akár imában és együttműködésben.\n\nHa úgy érzed, hogy egy nehéz és fontos területre hív az Isten, ahol nem mindig látszik azonnal az eredmény, de mégis kitartóan jelen kell lenni, akkor ez az előadás neked szól.\n\nHa úgy érzed, hogy ott kell építened, ahol nincs kész út, bölcsességgel kell helytállnod a nehéz helyzetekben, és egy nálad nagyobb ügyet kell hűséggel hordoznod, ez az alkalom segít, hogy tisztánlátással és erővel tudj elindulni.",
            ],
            'father-heart-of-god' => [
                'title' => 'Jézusért lángoló generáció: Élj úgy mint Jézus - Brian & Valerie Britton',
                'short_description' => 'Tapasztald meg a mennyei Atya mély, feltétel nélküli szeretetét.',
                'description' => "Isten rendkívüli erőteljesen kijelenti magát ennek a nemzedéknek. Ezen az előadáson azt vizsgáljuk, hogy hogyan lehet a mi időnkben – a káosz és az ébredés közepette – gyakorlatilag Krisztushoz hasonló életet élni.\n\nSok szív már lángra lobbant Jézusért, de a kérdés az, hogyan tudjuk ezt a lángot nemcsak megélni, hanem tovább is vinni az életünkben és küldetésünkben – úgy, hogy Isten világossága és dicsősége egyre inkább betöltse a földet?\n\nEz az előadás segít abban, hogy ne csak átélői, hanem hordozói is legyünk Isten munkájának ebben az időben.\n\nHa szeretnél egy olyan életet, hogy ne csak megtapasztald Isten munkáját, hanem te magad is aktív hordozója legyél ebben az időben, akkor itt a helyed.",
            ],
            'father-heart-of-god-sunday' => [
                'title' => 'Jézusért lángoló generáció: Élj úgy mint Jézus - Brian & Valerie Britton',
                'short_description' => 'Tapasztald meg a mennyei Atya mély, feltétel nélküli szeretetét.',
                'description' => "Isten rendkívüli erőteljesen kijelenti magát ennek a nemzedéknek. Ezen az előadáson azt vizsgáljuk, hogy hogyan lehet a mi időnkben – a káosz és az ébredés közepette – gyakorlatilag Krisztushoz hasonló életet élni.\n\nSok szív már lángra lobbant Jézusért, de a kérdés az, hogyan tudjuk ezt a lángot nemcsak megélni, hanem tovább is vinni az életünkben és küldetésünkben – úgy, hogy Isten világossága és dicsősége egyre inkább betöltse a földet?\n\nEz az előadás segít abban, hogy ne csak átélői, hanem hordozói is legyünk Isten munkájának ebben az időben.\n\nHa szeretnél egy olyan életet, hogy ne csak megtapasztald Isten munkáját, hanem te magad is aktív hordozója legyél ebben az időben, akkor itt a helyed.",
            ],
            'prophetic-ministry' => [
                'title' => 'Prófétai hang - Tineke Bouwman',
                'short_description' => 'Növekedj a prófétai ajándékban, és tanuld meg, hogyan szolgálj pontossággal és szeretettel.',
                'description' => 'Tineke Bouwman tapasztalt prófétai hangja megtanít arra, hogyan halljuk tisztán Isten hangját, hogyan adjunk át prófétai szavakat pontossággal és szeretettel, és hogyan növekedjünk ebben a fontos ajándékban Krisztus testének építésére.',
            ],
            'prophetic-ministry-sunday' => [
                'title' => 'Prófétai hang - Tineke Bouwman',
                'short_description' => 'Növekedj a prófétai ajándékban, és tanuld meg, hogyan szolgálj pontossággal és szeretettel.',
                'description' => 'Tineke Bouwman tapasztalt prófétai hangja megtanít arra, hogyan halljuk tisztán Isten hangját, hogyan adjunk át prófétai szavakat pontossággal és szeretettel, és hogyan növekedjünk ebben a fontos ajándékban Krisztus testének építésére.',
            ],
            'prophetic-arts' => [
                'title' => 'Jézus gyönyörű szíve: Szabadságra jutni a kreatív mozgás által',
                'short_description' => 'Fejezd ki az imádást és a prófétai kijelentést kreatív és vizuális művészeteken keresztül.',
                'description' => "Szeretettel hívunk Dr. Kate Hartman prófétai workshopjára, amelynek középpontjában Jézus Krisztus áll – aki szeretettel fordul hozzánk, meggyógyítja a megtört szívűeket és helyreállítja az összetört reményeket.\n\nFedezd fel az Ő jelenlétének valóságát, miközben a Szentlélek vezetésével a belső gyógyulás és a szabadság útjára lépsz a kreatív mozgás által. Hagyd magad mögött a múlt terheit és indulj el egy kegyelemmel és reménységgel teljes jövő felé, miközben egyre mélyebben megismered Jézus szívét.",
            ],
            'prophetic-arts-sunday' => [
                'title' => 'Jézus gyönyörű szíve: Szabadságra jutni a kreatív mozgás által',
                'short_description' => 'Fejezd ki az imádást és a prófétai kijelentést kreatív és vizuális művészeteken keresztül.',
                'description' => "Szeretettel hívunk Dr. Kate Hartman prófétai workshopjára, amelynek középpontjában Jézus Krisztus áll – aki szeretettel fordul hozzánk, meggyógyítja a megtört szívűeket és helyreállítja az összetört reményeket.\n\nFedezd fel az Ő jelenlétének valóságát, miközben a Szentlélek vezetésével a belső gyógyulás és a szabadság útjára lépsz a kreatív mozgás által. Hagyd magad mögött a múlt terheit és indulj el egy kegyelemmel és reménységgel teljes jövő felé, miközben egyre mélyebben megismered Jézus szívét.",
            ],
            'iris-global-alumni-gathering' => [
                'title' => 'Iris Harvest School – egykori tanulók találkozója',
                'short_description' => 'Különleges találkozó az Iris Global Harvest School of Missions egykori hallgatói számára. Csak azok jelentkezhetnek, akik tanultak az Iris Globalban.',
                'description' => 'Heidi Baker és az Iris misszionáriusok különleges találkozót tartanak az Iris Global Harvest School of Missions egykori hallgatói számára. Kapcsolódj újra, oszd meg a bizonyságodat, és frissüljetek meg együtt.',
            ],
        ]);
    }

    private function seedScheduleItems(): void
    {
        // Schedule items don't have slugs — match by (day, title)
        $items = [
            ['2026-10-22', 'Registration & Check-in', [
                'title' => 'Regisztráció',
            ]],
            ['2026-10-22', 'Ministry Team Training Day', [
                'title' => 'Szolgálati csapat felkészítő nap',
                'description' => 'David Gava és az Iris Ministry csapat vezetői képzést tartanak az eseményen szolgálók és az önkéntesek számára. (Közben ebédszünet.)',
            ]],
            ['2026-10-22', 'Lunch Break', [
                'title' => 'Ebédszünet',
            ]],
            ['2026-10-23', 'Pastors & Leaders Session', [
                'title' => 'Pásztorok & Vezetők alkalma',
                'description' => 'Különleges találkozó pásztorok, szolgálati vezetők és üzletemberek számára kávéval, teával és frissítőkkel. Az előadáson való részvétel csak meghívóval lehetséges.',
            ]],
            ['2026-10-23', 'Opening Session', [
                'title' => 'Nyitó alkalom',
                'description' => 'Dicséret, Vendégelőadó, Szolgálati idő',
                'location' => 'Nagyterem',
            ]],
            ['2026-10-24', 'Saturday Morning Main Session', [
                'title' => 'Szombat reggeli főalkalom',
                'description' => 'Dicséret, Vendégelőadó, Szolgálati idő',
                'location' => 'Nagyterem',
            ]],
            ['2026-10-24', 'Interactive Q&A Session', [
                'title' => 'Interaktív kérdezz&felelek alkalom',
                'description' => 'Interaktív K&F alkalom különleges vendégekkel',
                'location' => 'Nagyterem',
            ]],
            ['2026-10-24', 'Healing Rooms', [
                'title' => 'Ima szoba (Szolgálat gyógyulásért)',
                'description' => "15 perces személyes szolgálati alkalmak előzetes regisztrációval érhetők el. A jelentkezés a regisztrációt követően lehetséges; az esemény előtt néhány héttel e-mailben küldünk értesítést, amelyben megtalálod a jelentkezési űrlapot.\n\nFelhívjuk a figyelmed, hogy a helyek száma korlátozott, a jelentkezéseket beérkezési sorrendben fogadjuk.",
                'location' => 'Ima szoba',
            ]],
            ['2026-10-24', 'Prophetic Rooms', [
                'title' => 'Ima szoba (Prófétai szolgálat)',
                'description' => "15 perces személyes szolgálati alkalmak előzetes regisztrációval érhetők el. A jelentkezés a regisztrációt követően lehetséges; az esemény előtt néhány héttel e-mailben küldünk értesítést, amelyben megtalálod a jelentkezési űrlapot.\n\nFelhívjuk a figyelmed, hogy a helyek száma korlátozott, a jelentkezéseket beérkezési sorrendben fogadjuk.",
                'location' => 'Ima szoba',
            ]],
            ['2026-10-24', 'Street Evangelism', [
                'title' => 'Utcai evangelizálás',
                'description' => 'Lehetőséged van részt venni utcai evangelizációban: több csapattal fogunk Budapest különböző pontjaira kimenni, hogy megosszuk az evangéliumot és lássuk, ahogy emberek átadják az életüket Jézusnak. A jelentkezés a regisztrációt követően lehetséges; az esemény előtt néhány héttel e-mailben küldünk értesítést, amelyben megtalálod a jelentkezési űrlapot.',
            ]],
            ['2026-10-24', 'Merch & Ministry Booths', [
                'title' => 'Ajándéktárgyak standjai',
                'description' => 'Vásárolj a kiállított szolgálati ajándéktárgyainkból és kapcsolódj partner szervezeteinkhez.',
                'location' => 'Előcsarnok',
            ]],
            ['2026-10-24', 'Workshops', [
                'title' => 'Workshopok',
                'description' => 'Különböző workshopok közül választhatsz: Szenvedély, cél, tűz; Evangélizálás hatalommal; Ébredés és aratás; Isten atyai szíve; Üzleti missziók; Jézus gyönyörű szíve: szabadságra jutni a kreatív mozgás által; Prófétai hang; Jézusért lángoló generáció: Élj úgy mint Jézus; Emberkereskedelem valamint Iris Global tanulói részére találkozó.',
                'location' => 'Több helyiség',
            ]],
            ['2026-10-24', 'Saturday Evening Session', [
                'title' => 'Szombat esti alkalom',
                'description' => 'Dicséret, Vendégelőadó, Szolgálati idő',
                'location' => 'Nagyterem',
            ]],
            ['2026-10-25', 'Sunday Morning Main Session', [
                'title' => 'Vasárnap reggeli főalkalom',
                'description' => 'Dicséret, Vendégelőadó, Szolgálati idő',
                'location' => 'Nagyterem',
            ]],
            ['2026-10-25', 'Sunday Afternoon Session', [
                'title' => 'Vasárnap délutáni alkalom',
                'description' => 'Dicséret, Vendégelőadó, Szolgálati idő',
                'location' => 'Nagyterem',
            ]],
            ['2026-10-25', 'Healing Rooms', [
                'title' => 'Ima szoba (Szolgálat gyógyulásért)',
                'description' => "15 perces személyes szolgálati alkalmak előzetes regisztrációval érhetők el. A jelentkezés a regisztrációt követően lehetséges; az esemény előtt néhány héttel e-mailben küldünk értesítést, amelyben megtalálod a jelentkezési űrlapot.\n\nFelhívjuk a figyelmed, hogy a helyek száma korlátozott, a jelentkezéseket beérkezési sorrendben fogadjuk.",
                'location' => 'Ima szoba',
            ]],
            ['2026-10-25', 'Prophetic Rooms', [
                'title' => 'Ima szoba (Prófétai szolgálat)',
                'description' => "15 perces személyes szolgálati alkalmak előzetes regisztrációval érhetők el. A jelentkezés a regisztrációt követően lehetséges; az esemény előtt néhány héttel e-mailben küldünk értesítést, amelyben megtalálod a jelentkezési űrlapot.\n\nFelhívjuk a figyelmed, hogy a helyek száma korlátozott, a jelentkezéseket beérkezési sorrendben fogadjuk.",
                'location' => 'Ima szoba',
            ]],
            ['2026-10-25', 'Street Evangelism', [
                'title' => 'Utcai evangelizálás',
                'description' => 'Lehetőséged van részt venni utcai evangelizációban: több csapattal fogunk Budapest különböző pontjaira kimenni, hogy megosszuk az evangéliumot és lássuk, ahogy emberek átadják az életüket Jézusnak. A jelentkezés a regisztrációt követően lehetséges; az esemény előtt néhány héttel e-mailben küldünk értesítést, amelyben megtalálod a jelentkezési űrlapot.',
            ]],
            ['2026-10-25', 'Merch & Ministry Booths', [
                'title' => 'Ajándéktárgyak standjai',
                'description' => 'Vásárolj a kiállított szolgálati ajándéktárgyainkból és kapcsolódj partner szervezeteinkhez.',
                'location' => 'Előcsarnok',
            ]],
            ['2026-10-25', 'Workshops', [
                'title' => 'Workshopok',
                'description' => 'Különböző workshopok közül választhatsz: Szenvedély, cél, tűz; Evangélizálás hatalommal; Ébredés és aratás; Isten atyai szíve; Üzleti missziók; Jézus gyönyörű szíve: szabadságra jutni a kreatív mozgás által; Prófétai hang; Jézusért lángoló generáció: Élj úgy mint Jézus; Emberkereskedelem valamint Iris Global tanulói részére találkozó.',
                'location' => 'Több helyiség',
            ]],
            ['2026-10-25', 'Closing Session', [
                'title' => 'Záró alkalom',
                'description' => 'Dicséret, Vendégelőadó, Szolgálati idő',
                'location' => 'Nagyterem',
            ]],
        ];

        foreach ($items as [$day, $title, $hu]) {
            $item = ScheduleItem::query()
                ->whereDate('day', $day)
                ->where('title', $title)
                ->first();
            if (! $item) {
                continue;
            }
            $translations = $item->translations ?? [];
            $translations['hu'] = array_filter(
                array_merge($translations['hu'] ?? [], $hu),
                fn ($v) => $v !== null && $v !== '',
            );
            $item->translations = $translations;
            $item->save();
        }
    }

    private function seedFaqs(): void
    {
        // FAQs — match by English question (must match DB exactly)
        $faqs = [
            'Who can attend Europe Revival 2026?' => [
                'question' => 'Kiknek szól a Europe Revival 2026?',
                'answer' => 'A Europe Revival mindenki számára nyitott – hívők, Isten-keresők, gyülekezeti vezetők vagy bárki számára, aki éhezik az Istennel való találkozásra. Akár tapasztalt szolgáló vagy, akár új a hitben, szeretettel várunk Budapesten.',
            ],
            'Where is the conference held?' => [
                'question' => 'Hol kerül megrendezésre a konferencia?',
                'answer' => "A Europe Revival 2026 a budapesti BOK Csarnokban kerül megrendezésre.\n\nCím: Budapest, 1146, Dózsa György út 1, 1146",
            ],
            'Will there be a livestream available?' => [
                'question' => 'Lesz élő közvetítés?',
                'answer' => 'Igen! A közös alkalmakat élőben közvetítjük azok számára, akik nem tudnak személyesen részt venni. Ennek ellenére mindenkit bátorítunk a személyes részvételre, hogy megtapasztalhassátok az ébredés légkörét és hogy lehetőségetek legyen arra, hogy személyesen szolgáljanak felétek.',
            ],
            'What languages will be available?' => [
                'question' => 'Milyen nyelven kerül megrendezésre a konferencia?',
                'answer' => 'A konferencia angol és magyar nyelven kerül megrendezésre, szinkrontolmácsolással német, román és orosz nyelvekre. A helyszínen tolmácseszközöket biztosítunk.',
            ],
            'Is childcare available?' => [
                'question' => 'Biztosítanak gyermekfelügyeletet?',
                'answer' => 'Igen, a közös alkalmak alatt lesz felügyelet gyermekprogram 4-12 éves korig. A 4 év alatti gyermekek szülői felügyelettel maradhatnak a gyermekszolgálatba. A gyermekfelügyeletre előzetes regisztráció szükséges.',
            ],
            'Are meals included?' => [
                'question' => 'Az ár magában foglalja az étkezéseket?',
                'answer' => 'Az étkezés nincs benne a regisztrációs díjban, viszont a helyszínen lesz lehetőség ételt vásárolni, illetve a helyszín környékén több étterem és kávézó is található. A szünetekben a büfében lesz lehetőség a kapcsolatépítésre.',
            ],
            'How do I apply to Volunteer?' => [
                'question' => 'Hogyan jelentkezhetek önkéntesnek?',
                'answer' => 'Megnyílt az önkéntes jelentkezés! Töltsd ki a jelentkezési lapot, és mondd el, hogyan szeretnél szolgálni. Minden önkéntes kedvezményes támogatói jeggyel vehet részt az eseményen, és ajándék rendezvénypólót kap. A jelentkezési határidő 2026. szeptember 1.',
            ],
            'Where can I stay if I\'m coming for multiple days?' => [
                'question' => 'Hol tudok megszállni, ha több napra érkezem?',
                'answer' => 'Budapest széles választékban kínál szálláslehetőségeket különböző árkategóriákban, a megfizethető hostelektől kezdve, az Airbnb apartmanoktól át a helyszín közelében lévő szállodákig. Az eseményhez közeledve majd megosztjuk az ajánlott szállások listáját.',
            ],
            'How can I support the work of Iris?' => [
                'question' => 'Hogyan támogathatom az Iris munkáját?',
                'answer' => 'Ha szeretnéd támogatni az Iris küldetését, további információkat az iriskrakow.org oldalon találsz. Nagylelkűséged hozzájárul az Európa-szerte végzett munkánkhoz, segít fényt hozni a sötétségbe, gyógyulást a megtörteknek és Isten szeretetét azoknak, akiket senki sem szeret.',
            ],
            'How do I apply for the Ministry Team?' => [
                'question' => 'Hogyan jelentkezhetek a szolgálócsapatba?',
                'answer' => 'A szolgálócsapatba való jelentkezés nyitva van! A jelentkezéshez ki kell töltened a jelentkezési lapot a bizonyságoddal és pásztori ajánlással együtt. A jóváhagyott csapattagok ingyenes részvételt kapnak a konferencián cserébe a gyógyító szobákban, prófétai szolgálatban vagy gyakorlati segítségnyújtásban való szolgálatért. Jelentkezési határidő: 2026. szeptember 1.',
            ],
            'Where will the conference be held?' => [
                'question' => 'Hol kerül megrendezésre a konferencia?',
                'answer' => 'A Europe Revival 2026 Budapesten kerül megrendezésre. A pontos helyszín és cím hamarosan elérhető lesz. Maradj velünk a frissítésekért!',
            ],
            // Ministry-team page FAQs (category = 'ministry') — stored as HTML so the
            // Filament RichEditor in the admin can edit them directly.
            'Where will the one-day training take place?' => [
                'question' => 'Hol lesz az 1 napos tréning nap?',
                'answer' => '<p>A tréning nap helyszínét e-mailen fogjuk kiküldeni azoknak, akiknek a jelentkezését elfogadtuk.</p>',
            ],
            'How should I arrange accommodation?' => [
                'question' => 'Hogyan oldjam meg a szállást?',
                'answer' => '<p>Az esemény a BOK Sportcsarnokban (1146 Budapest, Dózsa György út 1) kerül megrendezésre, ezért a közelben vagy jól megközelíthető tömegközlekedéssel elérhető helyen javasoljuk a szállásfoglalást.</p><p>A több ezer fős esemény mérete miatt nem tudunk szállást biztosítani a szolgálati csapat számára, azonban mellékeljük a környéken ajánlott szálláshelyek listáját.</p><p><strong>Szálláshely lista kiírása hamarosan!</strong></p>',
            ],
            'Is food provided?' => [
                'question' => 'Van étkezés biztosítva?',
                'answer' => '<p>Az étkezés nem része a regisztrációnak, viszont a környéken számos étterem található. (Kb. 5–10 euró között)</p>',
            ],
            'How do I get to the venue?' => [
                'question' => 'Hogyan jutok el a helyszínre?',
                'answer' => '<p>Budapest könnyen megközelíthető repülővel, vonattal és busszal egyaránt.</p><ul><li>Repülőtérről: 100E busz a Deák térig (~30 perc)</li><li>Metró és villamos a helyszín közelében</li><li>Parkolás korlátozott — tömegközlekedés ajánlott</li></ul><p>Javasoljuk az <a href="https://www.uber.com/global/en/cities/budapest/" target="_blank" rel="noopener">Uber</a> vagy a <a href="https://bolt.eu/en/cities/budapest/" target="_blank" rel="noopener">Bolt</a> használatát.</p>',
            ],
            'How does the application process work?' => [
                'question' => 'Hogyan zajlik a jelentkezés?',
                'answer' => '<ul><li>Töltsd ki az online jelentkezési űrlapot</li><li>Megkeressük a lelkipásztorodat referenciáért</li><li>Elbíráljuk a jelentkezésedet</li><li>E-mailben értesítünk a döntésről</li></ul>',
            ],
            'Why is a pastoral reference required?' => [
                'question' => 'Miért kell lelkipásztori ajánlás?',
                'answer' => '<p>A lelkipásztori ajánlás biztosítja, hogy a szolgálati csapat tagjai aktív, beépült tagjai egy helyi gyülekezetnek.</p><p>A lelkipásztorod igazolja:</p><ul><li>A gyülekezeti hovatartozásod</li><li>A hited gyakorlása a mindennapokban</li><li>Alkalmasságod a szolgálatra</li></ul>',
            ],
        ];

        foreach ($faqs as $englishQuestion => $hu) {
            $faq = Faq::query()->where('question', $englishQuestion)->first();
            if (! $faq) {
                continue;
            }
            $translations = $faq->translations ?? [];
            $translations['hu'] = array_filter(
                array_merge($translations['hu'] ?? [], $hu),
                fn ($v) => $v !== null && $v !== '',
            );
            $faq->translations = $translations;
            $faq->save();
        }
    }
}
