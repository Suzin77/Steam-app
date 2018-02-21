<div class = "container">
	
<h4>1 Architektura oprogramowania</h4>

<p>Od kiedy zacząłem czytać o OOP cały czas pojawiają się pytania o zastosowania pewnych mechanik. W necie jest bardzo dużo treści na ten temat jednak jako nowicjusz nie  jestem w stanie zweryfikować merytorycznej jakości tych materiałów dlatego też zdecydowałem się zadać je Tobie. </p>

<p>Bardzo łatwo jest znaleźć informację na temat tego co to jest np. klasa abstrakcyjna, statyczna, interfejs oraz jak się takie elementy koduje i jak działają. Za to prawie nigdzie nie ma albo jest zdawkowo napisane o tym dlaczego i w jaki kontekście zastosowanie danego mechanizmu daje nam korzyści. Np. Klasa Abstrakcyjna, zazwyczaj stosowana jako klasa główna po której dopiero dziedziczą klasy pochodne już używane w aplikacji. W jakim celu mam tworzyć klasę abstrakcyjną ? Dlaczego mam blokować możliwość tworzenia instancji tej klasy ? Jaką korzyść daje mi zastosowanie takiego rozwiązania.</p> 

<p>Klasy/metody statyczne. Czy możesz m napisać np. w naszym systemie do czego są wykorzystywane metody statyczne ? Dlaczego właśnie do tego używamy klasy statycznej ? Dlaczego nie potrzebujemy do danej czynności tworzyć obiektu klasy ? Jak teraz napisałem te pytania to się  zacząłem zastanawiać że np. będziemy potrzebowali przeliczyć walutę w sklepie, do tego może być właśnie klasa Kantor i metoda convert($fromCurr, $toCurr, $currRate ). I wtedy Kantor::convert($fromCurr, $toCurr, $currRate) przekonwertuje walutę i nie muszę mieć obiektu . Czy w dobrym kierunku myślę?</p>

<p>Oczywiście nie oczekuję że napiszesz mi wykład na ten temat jednak wskazanie kierunku, może książki, albo jakiś zasobów w sieci, jeżeli znasz będzie super. Może znasz jakiś mały projekt z "prawidłową" implementacją tych możliwości.</p>	

<h4>2 Pytanie o projekt aplikacji.</h4> 

Szkielet MVC znalzłem przykładowy na githubie i go użyłem.
Aktualnie jest jeszcze dużo bajzlu, dwie największe klasy muszę rozdzielić na mniejsze. Do projektowania siadłem po kilku dniach pisania bo zobaczyłem że dwie, trzy boskie klasy to nie jest dobra droga.
<h5>Co robi aplikacja:</h5>
<p>- sprawdza poprzez steam API informacje o użytkowniku. Niestety steam nie pozwala na odpytanie o nick ale tylko o User ID. </p>
<p>- po wyszukaniu usera dane o nim są zapisywane w bazie. Dane o jego grach też będą zapisywane. </p>

<h5>Aplikacja jest podzielona na moduły</h5>
<p>- Data, moduł wyświetla informacje zgromadzone w bazie, będzie pozwalał na wyszukiwanie użytkowników lub gier.</p> 
<p>- Admin, wyświetla statystyki trochę danych analitycznych, pozwala na ręczną aktualizację danych (przenieść do cronów)</p>
<p>- SteamAPI, odpytuje API i wyświetla informacje</p>

<p>Ze względu na rozrost dwóch klas steamusersmodel oraz steamapiusersmodel przeprojektowałem aplikację.
Architektura docelowa, aktualnie w wielu miejscach kodu jeszcze nie zaimplementowana.</p>

<p>Dodatkowo jest kontroler Admin, który w index pokazuje statystyki z modelu statsmodel i countryStatsModel (dziedziczy po statModel) </p>

W widoku wymyśliłem ze tez mogę klasę utworzyć która będzie budować kod HTML rekurencyjnie na podstawie przekazanych danych z bazy. Widzę jednak pewne ograniczenia i aktualnie jest to temat do przemyślenia.

Czyli generalnie mam osobne modele odczytu i zapisu dla API i Bazy oraz modele pomocnicze do wykonywania innych czynności. 

Chciałem się zapytać czy generalnie kierunek jaki obrałem wg ciebie jest dobry. Jeżeli widzisz jakieś rażące błędy w tej koncepcji będę wdzięczny za zwrócenie uwagi . Może też widzisz w takim projekcie funkcjonalności jakiś wzorzec do zastosowania. Napisz jaki, resztę sobie odczytam. Sam czuje jakość że chyba by mi się przydała jeszcze jedna "warstwa abstrakcji" coś pomiędzy warstwą pobierania,zapisywania danych a kontrolerami, taki pośredni model.

<h4> 3 Metodologia pisania kodu</h4>

Znalazłem stronę
http://mitsloan.mit.edu/shared/content/PHP_Code_Style_Guide.php
Czy możesz potwierdzić że takie standardy sąw miarę aktualnie.Mam świadomość ze dokument jest obszerny jednak mi chodzi tylko o ogólne przejżenie. A może jednak metodologię kodowania w każdej firmie/projekcie ustala się indywidualnie, w ramach ogólnych standardów a ważniejsze jest aby cały zespół się stosował do tych ustaleń niż to jakie to są dokładnie są ustalenia?

<h4>4 Zewnętrzne biblioteki, FW i inne.</h4>

<p>Jako że ten projekt jest projektem czysto szkoleniowym i moim celem jest poznanie jak największej ilości mechanizmów pisząc w czystym PHP to jednak widzę ze pewne czynności się powtarzają i czy w takiej sytuacji zalecałbyś już rozpoczęcie używania np. jakiego ORM, (PDO jest już używany ), może Doctrine ? Może jednak od razu brać sie za Symfony czy też laravel. Generalnie na podstawie doświadczenia, jakie biblioteki możesz polecić, coś co na pewno wg ciebie jest dobre. Tak jak pisałem w necie jest bardzo dużo informacji jednak na początku trudniej jest zweryfikować które polecenia są wartościowe. 
Jeżeli masz klika słów kluczowych albo linków  to będę wdzięczny.</p>

<h4>Posumowanie.</h4>
Jak nabardziej zdaję sobie sprawę tego że są to rozbudowane pytania, nie licze na mecha szybką odpowiedź ale każde wskazówki bardzo moga mi pomóc. Jak wspomniałem wcześniej, materiałow w sieci jest bardzo dużo. Jednak najwiekszym problemem jest brak możliwośći weryfikowania znalezionych informacji pod kontem merytorycznym. Chyba taka umiejętności przychodzi z doświadczeniem. 

<h4>Kontakt</h4>
 <p>patrycjusz.sosnowski"at"gamil.com albo FB. Ewentualnie formularz poniżej.</p>
 

<form action="<?php echo URL; ?>admin/answer/" id = "usrform" method="POST">
	<textarea rows="14" cols="100" name="answer" form="usrform">
Wpisz odpowiedz tutaj.
	</textarea>
	<input type="submit">
</form>
</div>