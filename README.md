<h1>Publishdrive Test<h2>
<h3>
    Frontend, Backend és Database feladatok megoldása
</h3>

<p>
    Klónozás után futtatni kell a 'composer install' és 'npm i' parancsokat, és a config\app.php fáljban megadni az "epub_checker" config elemnek az epubchecker könívtár elérési útját, mivel ezen keresztül fogja futtatni az epub ellenőrzést
</p>
<p>
    A főoldalon látható menük a következők:
    <ul>
        <li>Home - Főoldal</li>
        <li>Epub - Backend feladat: Rákkattintva az egyik elemre lefuttatja a letöltést, metadata kiolvasást, és epub ellenőrzést, majd fealjánlja az xml fájl letöltését</li>
        <li>Data - Frontend feladat: Megjeleníti a megadott json fájlból az adatokat. Mindegyik elemhez tartozik egy toggle, melyel a rejtett adatokat lehet megnézni</li>
    </ul>
</p>
<p>
    Az adatbázis feladat megoldásai az applikáció főkönyvtárában találhatóak:
    <ul>
        <li>forgalom_HU.sql</li>
        <li>forgalom_EUR.sql</li>
    </ul>
</p>
