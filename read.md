<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hello!</title>
<link rel="stylesheet" href="https://stackedit.io/res-min/themes/base.css" />
<script type="text/javascript" src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_HTML"></script>
</head>
<body><div class="container"><p>Skoro tu jesteś to znaczy, że chcesz się <strong>uczyć</strong>!  <br>
Postaramy się nauczyć Cię, jak dobrze pracować z plikami PHP. Omówimy główną strukturę pliku PHP tak, abyś potrafił odróżnić zmienną od komentarza. Zahaczymy również o dobre narzędzia, które ułatwią pracę z PHP, oraz przekażemy kilka wskazówek dotyczących pisania kodu.</p>

<p><strong>Wygląd przykładowego pliku PHP:</strong></p>



<pre class="prettyprint"><code class="language-php hljs "><span class="hljs-comment"># web/app.php</span>
<span class="hljs-keyword">use</span> <span class="hljs-title">Symfony</span>\<span class="hljs-title">Component</span>\<span class="hljs-title">HttpFoundation</span>\<span class="hljs-title">Request</span>;

<span class="hljs-variable">$loader</span> = <span class="hljs-keyword">require_once</span> <span class="hljs-keyword">__DIR__</span> . <span class="hljs-string">'/../app/bootstrap.php.cache'</span>;
<span class="hljs-keyword">require_once</span> <span class="hljs-keyword">__DIR__</span> . <span class="hljs-string">'/../app/AppKernel.php'</span>;


<span class="hljs-comment">// Enable APC for autoloading to improve performance.</span>
<span class="hljs-comment">// You should change the ApcClassLoader first argument to a unique prefix</span>
<span class="hljs-comment">// in order to prevent cache key conflicts with other applications</span>
<span class="hljs-comment">// also using APC.</span>
<span class="hljs-comment">/*
$apcLoader = new ApcClassLoader(sha1(__FILE__), $loader);
$loader-&gt;unregister();
$apcLoader-&gt;register(true);
*/</span>

<span class="hljs-variable">$kernel</span> = <span class="hljs-keyword">new</span> AppKernel(<span class="hljs-string">'prod'</span>, <span class="hljs-keyword">false</span>);
<span class="hljs-variable">$kernel</span>-&gt;loadClassCache();

<span class="hljs-variable">$request</span>  = Request::createFromGlobals();

<span class="hljs-variable">$response</span> = <span class="hljs-variable">$kernel</span>-&gt;handle(<span class="hljs-variable">$request</span>);
<span class="hljs-variable">$response</span>-&gt;send();

<span class="hljs-variable">$kernel</span>-&gt;terminate(<span class="hljs-variable">$request</span>, <span class="hljs-variable">$response</span>);</code></pre>

<hr>



<h1 id="tagi">Tagi</h1>

<p><strong><code>&lt;?php</code></strong> oraz <strong><code>?&gt;</code></strong> - Jest charakterystycznym znakiem rozpoznawczym języka PHP. To, co znajduje się pomiędzy nimi, uważane jest przez interpreter jako kod właściwy, który musi obsłużyć.</p>

<p><strong><code>&lt;?=</code></strong> oraz <strong><code>?&gt;</code></strong> - są to specjalne tagi które zawsze będą działać, ich zadanie to wyświetlanie jakiejś wartości. Często są stosowane w skompilowanych szablonach. </p>

<p><strong>Przykład:</strong></p>



<pre class="prettyprint"><code class="language-html hljs "><span class="hljs-comment">&lt;!-- kod html --&gt;</span>
<span class="hljs-tag">&lt;<span class="hljs-title">p</span>&gt;</span>Aktualna cena: <span class="php"><span class="hljs-preprocessor">&lt;?</span>= <span class="hljs-variable">$totalPrice</span> <span class="hljs-preprocessor">?&gt;</span></span> <span class="hljs-tag">&lt;/<span class="hljs-title">p</span>&gt;</span>
<span class="hljs-comment">&lt;!-- kod html --&gt;</span></code></pre>

<p>Zastępują one dokładnie taką konstrukcję:</p>



<pre class="prettyprint"><code class="language-php/html hljs xml"><span class="hljs-tag">&lt;<span class="hljs-title">p</span>&gt;</span>Aktualna cena: <span class="php"><span class="hljs-preprocessor">&lt;?php</span> <span class="hljs-keyword">echo</span> <span class="hljs-variable">$totalprice</span> <span class="hljs-preprocessor">?&gt;</span></span> <span class="hljs-tag">&lt;/<span class="hljs-title">p</span>&gt;</span></code></pre>



<h1 id="komentarze">Komentarze</h1>

<p>Komentarze w języku PHP są podobne, jak w wielu językach programowania mają podobne działanie. Służą tylko i wyłącznie dla programisty i jego kolegów.</p>

<p>Istnieją trzy typy komentarzy.  Są to komentarze wymienione poniżej.</p>



<h2 id="wieloliniowe">Wieloliniowe</h2>



<pre class="prettyprint"><code class="language-php hljs "><span class="hljs-preprocessor">&lt;?php</span>
<span class="hljs-comment">/* 
 *  Tutaj
 *  Komentarz
 */</span></code></pre>

<p>Rozpoczynają się od /* a kończą  */. Oczywiście w tym przykładzie nie jest konieczne co nową linię wstawiać “gwiazdkę”. </p>



<h2 id="jednoliniowe">Jednoliniowe</h2>

<p>Do jednoliniowych zaliczamy tekst rozpoczynający się od <strong><code>//</code></strong> lub <strong><code>#</code></strong> - aczkolwiek częściej spotkać można zapis <code>// my pretty comment</code></p>



<pre class="prettyprint"><code class="language-php hljs "><span class="hljs-preprocessor">&lt;?php</span>
<span class="hljs-comment">// this is inline comment</span>
<span class="hljs-comment"># same here!</span></code></pre>



<h2 id="specjalne">Specjalne</h2>

<p>Przykład komentarza specjalnego:</p>



<pre class="prettyprint"><code class="language-php hljs "><span class="hljs-preprocessor">&lt;?php</span>
<span class="hljs-comment">/**
 *  Find sepcified user in Collection of users
 * <span class="hljs-phpdoc"> @param</span> User $user User Object
 * <span class="hljs-phpdoc"> @return</span> ArrayObject
 */</span>
<span class="hljs-keyword">public</span> <span class="hljs-function"><span class="hljs-keyword">function</span> <span class="hljs-title">find</span><span class="hljs-params">(User <span class="hljs-variable">$user</span>)</span>;</span></code></pre>

<p>Jak możesz zauważyć, są to komentarze dokumentacji. <br>
To specjalne komentarze, dzięki którym odpowiednie oprogramowanie (np. phpDocumentor) będzie mogło szybko i łatwo sporządzić dokumentację danej klasy/funkcji. <br>
Oczywiście  to nie jedyne zastosowanie tych komentarzy! <br>
Dzięki takim komentarzom inteligentne IDE są w stanie praktycznie natychmiast podpowiadać nam o co chodzi. Na przykład możemy za pomocą takiego komentarza poinformować IDE o typie zmiennej, który jest definiowany przez interfejs.</p>



<h2 id="komentarze-dla-innych-programistów">Komentarze dla innych programistów</h2>

<p>Warto wspomnieć tutaj o tym, do czego poszczególne rodzaje komentarzy są wykorzystywane przez programistów. Oczywiście mogę z ręką na sercu powiedzieć, że piszemy dobre komentarze, jak i złe. </p>



<h3 id="dobre-komentarze">Dobre komentarze</h3>



<h4 id="prawne-komentarze"><strong>Prawne komentarze</strong></h4>

<p>Umieszczane są na początku pliku, występują one w komentarzu wielolinijkowym lub jednolinijkowym w zależności od ilości informacji, które w sobie zawierają. Zwykle są informacje o licencji dla każdej części oprogramowania lub o autorze modułu.</p>

<p><strong>Przykład komentarza wielolinijkowego:</strong></p>



<pre class="prettyprint"><code class="language-php hljs "><span class="hljs-comment">/********************************************************************
Copyright (C) 2015  PHPKurs

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see &lt;http://www.gnu.org/licenses/&gt;.
**********************************************************************/</span></code></pre>

<p><strong>Przykład komentarza jednolinijkowego:</strong></p>



<pre class="prettyprint"><code class="language-php hljs "><span class="hljs-comment">// Copyright (C) 2015 PHPKurs</span></code></pre>



<h4 id="informacyjne"><strong>Informacyjne</strong></h4>

<p>Zazwyczaj umieszczane są w jednolinikowych  <code>//</code> (patrz plik PHP na początku rozdziału) zawierają informację dla drugiego programisty o instrukcji np ładowania klas z pamięci.</p>



<h4 id="zamierzeń"><strong>Zamierzeń</strong></h4>

<p>[ @event15 uzupelnij ]</p>



<h4 id="wyjaśnienie"><strong>Wyjaśnienie</strong></h4>

<p>[ @event15 ]</p>



<h4 id="ostrzeżenie-o-konsekwencjach"><strong>Ostrzeżenie o konsekwencjach</strong></h4>

<p>Są zazwyczaj informacją w komentarzach jednolinikowych <code>//</code>  ostrzegającą na przykład o tym, że uruchomienie “<strong>tego</strong>” będzie miało poważny skutek w postaci spadku wydajności.</p>



<h4 id="komentarze-todo"><strong>Komentarze TODO</strong></h4>

<p>Są dość często wykorzystywane na początku projektowania aplikacji w celu zrobienia listy TODO. Dziś są wyłapywane przez IDE, ponieważ generują dług technologiczny każdej aplikacji. Każdy komentarz TODO powoduje, że trzeba będzie kiedyś wrócić do tego miejsca. O ile na początku projektowania aplikacji mogą być uznane za przydatne, o tyle później może zabrać kilka godzin pracy, jeśli wróci się do takiego komentarza po 2 miesiącach.  <br>
Wynika z tego to, że mimo iż jest to dobry typ komentarzy, to trzeba z nim postępować ostrożnie.</p>

<p><strong>Przykład komentarza <code>TODO</code>:</strong></p>



<pre class="prettyprint"><code class="language-php hljs "> <span class="hljs-preprocessor">&lt;?php</span>
   <span class="hljs-keyword">public</span> <span class="hljs-function"><span class="hljs-keyword">function</span> <span class="hljs-title">divide</span><span class="hljs-params">(<span class="hljs-variable">$numberA</span>, <span class="hljs-variable">$numberB</span>)</span>{</span>
     <span class="hljs-comment">//TODO: Implement this method.</span>
   }</code></pre>

<hr>



<h2 id="dobre-praktyki-pisania-komentarzy"><strong>Dobre praktyki pisania komentarzy</strong></h2>

<p>Często w książkach dla początkujących autorzy zachęcają do skrupulatnego komentowania swojego kodu. Argumentują takie rozumowanie tym, że w przyszłości wrócisz do swojego kodu, przeczytasz go, spojrzysz na komentarz i wszystko będzie jasne! </p>

<p>Oczywiście na pewnym etapie nauki programowania - raczkowanie - można stosować się do tej zasady. Początkującym pomaga to zrozumienie w jaki sposób stworzony kod działa (na przykład skomplikowana pętla, którą napisaliśmy, żeby zrozumieć jej dziwne działanie). Jednak kiedy spojrzymy w profesjonalny kod możemy się zdziwić i zbulwersować. <strong>Nie ma tam komentarzy</strong>. Przynajmniej tylu, ilu byśmy się spodziewali po takich gorących prośbach autorów książek. </p>

<p>Jak to się dzieje, że profesjonaliści nie komentują? Naprawdę są tacy mądrzy? Czytaj dalej :)</p>

<p><strong>Robert C. Martin</strong> <em>Czysty kod</em>:</p>

<blockquote>
  <p>W rzeczywistości komentarze są w najlepszym przypadku koniecznym złem. Jeżeli nasz język programowania jest wystarczająco ekspresyjny lub mamy wystarczający talent, by wykorzystywać ten język, aby wyrażać nasze zamierzenia, nie będziemy potrzebować zbyt wielu komentarzy.</p>
</blockquote>

<p>Jeżeli komentujesz wszystko obszernie co tylko się da, to znaczy, że Twój kod nie jest czysty.  </p>

<blockquote>
  <p>Czytelny kod nie wymaga komentarzy. </p>
</blockquote>

<p>Czytelny kod to taki który czytasz jak artykuł w gazecie, klasa mówi o tym co robi, funkcje/metody opisują siebie same, czytając zmienne wiesz o co chodzi bo nie są one zapisane np  int a,b,c,d. </p>



<h1 id="piszemy-o-php-i-w-php-kod-do-podmiany">PISZEMY O PHP I W PHP - KOD DO PODMIANY</h1>

<p><strong>Przykład</strong></p>



<pre class="prettyprint"><code class="language-java hljs "><span class="hljs-comment">// A</span>

<span class="hljs-comment">// Sprawdzenie czy pracownik ma prawo do wszystkich korzyści</span>
<span class="hljs-keyword">if</span> (( employee.flags &amp; HOURLY_FLAG) &amp;&amp; ( employee.age &gt; <span class="hljs-number">65</span> ) )


<span class="hljs-comment">// B</span>

<span class="hljs-keyword">if</span> ( employee.isEligibleForFullBenefits() ) </code></pre>

<p>osobiście wolałbym zobaczyć przykład drugi, bo gdy czytam ten kod, to go rozumiem. Komentarz jest zbędny. </p>



<h2 id="narzędzia">Narzędzia</h2>

<p>Każdy kiedyś zaczynał od notatnika… wie jak to się pisało.  <br>
Zero podpowiadania nazw funkcji, brak analizy kodu w czasie rzeczywistym. Praca z notatnikiem to była męczarnia, ale te czasy na szczęście już minęły! <br>
Zapamiętaj. Notatnik to nie IDE. </p>

<p>W tym kursie będziemy posługiwać się dwoma IDE.</p>

<ol>
<li><strong>Płatnym PHPStorm (najlepsze  płatne IDE dla PHP)</strong></li>
<li><strong>Darmowym NetBeans PHP (najlepszy darmowy IDE dla PHP)</strong></li>
</ol>

<p>Pokażemy Ci, że dużo wygodniej piszę się w takim Stromie niż notatniku. <br>
Oczywiście, w dalszych rozdziałach dowiemy się o narzędziach służących do tworzenia testów, specyfikacji klas,  będziemy pisać kod sterowany testami.  </p>

<p>To był tylko mały wstęp, jeżeli się nie poddasz i dotrzesz do części poświęconej testom, to gwarantujemy, że się zakochasz w testach!</p>



<h1 id="drogowskazy-aby-dążyć-do-doskonałości">Drogowskazy - aby dążyć do doskonałości</h1>

<p>Przyszła pora na <strong>najważniejszą</strong> część tego rozdziału.  Są to wskazówki, a raczej drogowskazy  <br>
Ciężko było nam wybrać, co dać jako pierwszą wskazówkę, ale później doszliśmy do wniosku, że nieważne co będzie pierwsze, ważne aby zostało zapamiętane!  Czytaj uważnie!</p>

<hr>



<h2 id="wskazówka-odnośnie-pisania-kodu-php">Wskazówka odnośnie pisania kodu PHP:</h2>

<p><strong><em>Zła praktyka:</em></strong> <br>
Mieszanie kodu PHP z HTML może się skończyć dla Ciebie tragicznie, Twojego projektu i kolaborantów. <br>
 Wyobraź sobie, że jesteś na miejscu pani Ewy, która dobrze zna się na HTML, ale z PHP nie miała zbytnio do czynienia. Dostała właśnie Twój projekt, ktoś tam kazał jej zmienić wygląd tabelki. Otwiera taki pomieszany plik i nie wie co tu się dzieje, zupełnie nie widzi gdzie kończy się tabelka a gdzie zaczyna. Skończyło się na tym, że zapomniała iż przez pomyłkę usunęła jakąś zmienną z kodu i bum. </p>

<p><strong>Dobra praktyka:</strong> <br>
Zawsze staraj się oddzielać kod PHP od HTML w swoich skryptach. Na początku będzie ciężko, ale z czasem wejdzie w nawyk. Odseparowanie warstwy widoku od warstwy logiki ułatwia bardzo pracę. </p>

<p>Pomyśl. <br>
PS: Zaplusujesz u pracodawcy :-)</p>



<h2 id="wskazówka-odnośnie-komentarzy">Wskazówka odnośnie komentarzy</h2>

<p>Niech komentarze wyjaśniają „dlaczego”, a nie „jak”. Komentarze, które <br>
wyjaśniają, jak coś jest wykonywane, operują zazwyczaj na poziomie języka <br>
programowania, a nie na poziomie problemu. Jest prawie niemożliwe, aby <br>
komentarz koncentrujący się na sposobie wykonywania operacji wyjaśniał jej <br>
cel. Komentarze takie są też najczęściej nadmiarowe. Czy poniższy komentarz <br>
zawiera jakiekolwiek informacje, których nie można znaleźć w kodzie? <br>
Przykład komentarza, który koncentruje się na „jak”</p>



<pre class="prettyprint"><code class="language-java hljs "><span class="hljs-comment">// jeżeli znacznik konta ma wartość zero</span>
<span class="hljs-keyword">if</span> ( $accountFlag == <span class="hljs-number">0</span> ) ...</code></pre>

<p>Przykład komentarza, który koncentruje się na „dlaczego” (Java)</p>



<pre class="prettyprint"><code class="language-java hljs "><span class="hljs-comment">// jeżeli zakładanie nowego konta</span>
<span class="hljs-keyword">if</span> ( $accountFlag == <span class="hljs-number">0</span> ) ...</code></pre>

<p>Przykład dobrego stylu programowania połączonego z komentarzem typu <br>
„dlaczego” </p>



<pre class="prettyprint"><code class="language-java hljs "><span class="hljs-comment">// jeżeli zakładanie nowego konta</span>
<span class="hljs-keyword">if</span> ( $accountType == $<span class="hljs-keyword">this</span>-&gt;accountType ) ...</code></pre>

<p>Gdy kod osiąga taki poziom czytelności, właściwe staje się kwestionowanie <br>
wartości komentarza. W tym przypadku lepszy kod sprawił, że komentarz jest <br>
nadmiarowy i prawdopodobnie powinien zostać usunięty. Można też nieco <br>
zmodyfikować jego rolę:</p>



<pre class="prettyprint"><code class="language-java hljs ">Przykład komentarza nagłówkowego (Java)
<span class="hljs-comment">// zakładanie nowego konta</span>
<span class="hljs-keyword">if</span> ( $accountType == $<span class="hljs-keyword">this</span>-&gt;accountType ) {
...
}</code></pre>

<p>Gdy komentarz opisuje cały blok kodu po teście if , staje się komentarzem <br>
podsumowującym i może pozostać w programie jako nagłówek opisujący następujący po nim akapit kodu.</p>

<hr>

<p><strong>Używaj komentarzy, aby przygotować czytającego kod na dalszy ciąg</strong>. Dobre <br>
komentarze informują czytającego kod o tym, czego powinien się spodziewać.  <br>
Osoba czytająca program powinna mieć możliwość przejrzenia samych <br>
tylko komentarzy i uzyskania dobrego obrazu tego, co dany kod robi i gdzie <br>
znaleźć poszczególne operacje. Wynika z tego między innymi zasada, że komentarz powinien zawsze poprzedzać to, co opisuje. Nie mówi się o tym na zajęciach <br>
z programowania, ale jest to powszechnie przestrzegana reguła. <br>
<strong>Niech każdy komentarz ma znaczenie</strong>. Nadmiar komentarzy nie przynosi żadnych korzyści — zbyt duża ich liczba zmniejsza czytelność opisywanego kodu. <br>
Zamiast pisać więcej komentarzy, lepiej włożyć dodatkowy wysiłek w zwiększenie czytelności samego programu</p>

<p><strong>Unikaj skrótów</strong>. Komentarze powinny być jednoznaczne i czytelne bez dodat- <br>
kowego wysiłku niezbędnego do rozszyfrowania znaczenia skrótów. Unikaj <br>
wszelkich skrótów poza najbardziej oczywistymi. Gdy nie wpisujesz komen- <br>
tarzy na końcu wierszy, nie jest to zazwyczaj problemem. Jeżeli jednak wpi- <br>
sujesz komentarze w taki sposób i pojawia się problem skrótów, potraktuj to <br>
jako kolejny argument przeciwko tej metodzie. <br>
Różnicuj rodzaje komentarzy. W pewnych przypadkach może pojawić się <br>
potrzeba różnicowania między poziomami komentarzy w sposób sygnalizujący, <br>
że komentarz szczegółowy jest częścią wcześniejszego, ogólniejszego. Można <br>
to robić różnymi metodami. Można spróbować podkreślania głównego komen- <br>
tarza i niepodkreślania szczegółowego.</p>

<p>Wadą tej metody jest to, że zmusza do podkreślania dużej liczby komentarzy. <br>
Jeżeli podkreślasz jeden komentarz, oznacza to, że wszystkie pozostałe, niepod- <br>
kreślone mają charakter podrzędny. W efekcie, gdy piszesz pierwszy komentarz, który nie jest podrzędny w stosunku do wcześniejszego podkreślonego <br>
komentarza, również musisz użyć podkreślenia. To samo dotyczy dalszych <br>
komentarzy. Kod zawiera wtedy zazwyczaj bardzo dużą liczbę podkreśleń lub <br>
podkreślenia nie są stosowane w sposób konsekwentny. <br>
Można wyróżnić kilka odmian tej metody, ale wszystkie one wiążą się z tymi <br>
samymi problemami. Jeżeli komentarze wyższego poziomu będą pisane wielkimi literami, a komentarze niższego poziomu — małymi, to problem zbyt <br>
wielu podkreśleń zastąpi problem zbyt wielu komentarzy pisanych wielkimi <br>
literami. Niektórzy programiści zaczynają ważniejsze komentarze wielką literą, <br>
a szczegółowe małą, ale jest to różnica bardzo subtelna i łatwa do przeoczenia.</p>

<p>Lepszą metodą jest wstawianie przed komentarzami szczegółowymi wielokropka.</p>

<p>Inną metodą, która często sprawdza się najlepiej, jest umieszczenie operacji <br>
opisywanej komentarzem wyższego poziomu w osobnej procedurze. Procedury <br>
powinny być logicznie „płaskie” — wszystkie ich operacje powinny być wykonywane na zbliżonym poziomie. Jeżeli kod wymaga różnicowania między operacjami wyższego i niższego poziomu, procedura nie ma takiego charakteru. <br>
Przeniesienie skomplikowanej grupy operacji do osobnej procedury pozwala <br>
uzyskać dwie procedury logicznie płaskie w miejsce jednej, logicznie niejednorodnej. <br>
Zagadnienie różnych poziomów komentarzy nie dotyczy wcinanego kodu <br>
wewnątrz pętli i instrukcji warunkowych. Wówczas stosuje się najczęściej jeden <br>
ogólny komentarz na początku pętli i komentarze bardziej szczegółowe wstawiane w obrębie wcinanego bloku. W takich przypadkach wcięcia jasno informują o organizacji logicznej komentarzy. Problem różnicowania poziomów <br>
dotyczy wyłącznie sekwencyjnych akapitów kodu, kiedy na pełną operację składa <br>
się kilka takich akapitów, a niektóre z nich mają charakter podrzędny. <br>
Opisuj komentarzami wszystko, co ma związek z błędami i nieudokumentowanymi cechami języka lub środowiska. Jeżeli masz do czynienia z błędem, <br>
jest on prawdopodobnie nieudokumentowany. Nawet jeżeli został gdzieś opisany, nie zaszkodzi dodatkowy opis w kodzie. Jeżeli masz do czynienia z nie- <br>
udokumentowaną cechą języka lub środowiska, to niejako z definicji brak jakiegokolwiek jej opisu i powinien on znaleźć się w programie.</p>

<p>Zapisuj uzasadnienia odstępstw od dobrego stylu programowania. Jeżeli <br>
musisz odejść od dobrego stylu programowania, wyjaśnij, dlaczego to robisz. <br>
Pozwoli to uniknąć sytuacji, w których pełen dobrych intencji programista <br>
dostosowuje kod do lepszego stylu, zmieniając zarazem jego działanie. Takie <br>
uzasadnienie będzie potwierdzeniem tego, że wiedziałeś, co robisz, i że zaskakująca konstrukcja nie wynika z niedbalstwa — nie pozwól, aby ktoś oskarżał <br>
Cię o pisanie złego kodu!</p>

<p>Starając się opisać kod, koncentruj się przede wszystkim na samym kodzie. <br>
Warto przypomnieć, że sam kod programu jest pierwszym rodzajem dokumentacji, który warto dopracować. W poprzednim przykładzie literał $ powinien zostać zastąpiony stałą nazwaną, a zmienne powinny dostarczać pełniejszych informacji o wykonywanych operacjach. Aby maksymalnie zwiększyć <br>
czytelność, należałoby jeszcze wprowadzić zmienną przechowującą wynik <br>
wyszukiwania. Zapewniłoby to wyraźne rozróżnienie między indeksem pętli <br>
a wynikiem.</p>

<p>Używaj komentarzy na końcu wierszy do opisywania deklaracji danych. <br>
Komentarze na końcu wierszy sprawdzają się przy opisywaniu deklaracji danych, <br>
ponieważ nie pojawiają się wtedy problemy typowe dla tego rodzaju komentarzy, gdy są stosowane do opisywania głównego kodu. Warunkiem jest oczy- <br>
wiście odpowiednia ilość dostępnego miejsca. 132 kolumny pozwalają zazwyczaj czytelnie opisać deklarację danych.</p>

<p>Używaj stylów, które nie sprawiają kłopotu przy wprowadzaniu zmian. <br>
Praktycznie każdy bardziej wyszukany styl sprawia problemy przy aktualizowaniu komentarzy i kodu. Spróbuj na przykład wskazać w poniższych komentarzach część, która jest najbardziej narażona na ignorowanie przez programistów wprowadzających zmiany</p>

<p>Istotną rzeczą jest to, aby zwracać uwagę na to, jak wykorzystywany jest czas <br>
poświęcany na pracę z kodem. Jeżeli spędzasz dużo czasu, wprowadzając i usuwając poziome kreski, aby dopasować długość podkreśleń do długości komentarzy, to nie jest to już programowanie, ale proste marnotrawienie czasu. Lepiej znaleźć inny, praktyczniejszy styl komentarzy. W przypadku podkreśleń roz- <br>
wiązaniem może być pozostawienie samych komentarzy, bez tego dodatkowego <br>
elementu. Jeżeli podkreślenia wydają się konieczne, są też inne możliwości. <br>
Jedną z nich jest stosowanie jednolitych podkreśleń, których długość nie jest <br>
związana z długością komentarzy. Takie podkreślenia nie wymagają późniejszego poprawiania i łatwo je wprowadzać przy użyciu makra edytora tekstu.</p>

<p>Aby zredukować czas poświęcany na pisanie komentarzy, używaj Procesu <br>
Programowania w Pseudokodzie. Pisanie zarysu programu w postaci komentarzy jeszcze przed rozpoczęciem budowy właściwego kodu niesie ze sobą <br>
kilka istotnych korzyści. Gdy kończy się praca z kodem, komentarze są już <br>
gotowe. Nie ma potrzeby poświęcania na nie dodatkowego czasu. Zyskujesz <br>
także wszystko to, co daje pisanie wysokopoziomowego pseudokodu przed <br>
utworzeniem niskopoziomowego kodu w języku programowania. <br>
Włączaj komentowanie do procesu programowania. Alternatywą dla włączenia pisania komentarzy do procesu programowania jest pozostawienie pracy <br>
nad nimi na sam koniec projektu. Ma to jednak wiele wad. Przede wszystkim, <br>
pisanie komentarzy staje się wtedy kolejnym zadaniem do wykonania, co <br>
sprawia, że wydaje się bardziej pracochłonne niż przy komentowaniu na bieżąco. <br>
Dodatkowo późne pisanie komentarzy jest faktycznie bardziej pracochłonne, <br>
bo zmusza do przypominania sobie lub sprawdzania, co robią poszczególne <br>
fragmenty kodu, zamiast prostego zapisania tego, co można zapisać bez zastanowienia w trakcie tworzenia tych fragmentów. Takie komentarze są też mniej <br>
dokładne, bo łatwo zapomnieć o niektórych założeniach i drobnych szczegółach projektu. <br>
Typowy argument przeciwko komentowaniu kodu na bieżąco brzmi: „Gdy <br>
koncentrujesz się na pracy z kodem, nie powinieneś rozpraszać się, pisząc <br>
komentarze”. Właściwą odpowiedzią na ten argument jest stwierdzenie, że <br>
jeżeli pisanie kodu wymaga tak silnej koncentracji, że komentowanie zaburza <br>
tok myślenia, to należałoby rozpocząć od napisania pseudokodu, a następnie <br>
przekształcić go w komentarze. Kod, który wymaga tak mocnej koncentracji, <br>
to ważny sygnał ostrzegawczy.</p>

<p>Jeżeli projekt jest trudny do zapisania w postaci kodu programu, uprość taki <br>
projekt, jeszcze zanim zaczniesz zajmować się komentarzami czy kodem. Jeżeli <br>
użyjesz do uporządkowania swoich zamysłów pseudokodu, pisanie kodu stanie <br>
się proste, a komentarze powstaną automatycznie. <br>
Wydajność nie jest dobrym powodem, by unikać komentarzy. Jedną z rzeczy, <br>
które wciąż powracają z kolejnymi falami technologii (patrz omówienie w podrozdziale 4.3, „Twoje położenie na fali technologii”), są środowiska interpretujące kod. Komentarze powodują w nich mierzalne obniżenie szybkości pracy. <br>
W latach osiemdziesiątych komentarze spowalniały pracę pisanych w Basicu <br>
programów na oryginalnym IBM PC. W latach dziewięćdziesiątych taki sam <br>
problem dotyczył stron .asp. W nowym wieku spotykamy się z nim przy <br>
przesyłaniu JavaScriptu i innego kodu wykonywanego po stronie klienta.</p>

<p>W każdym z tych przypadków optymalnym rozwiązaniem nie była rezygnacja z komentarzy. Było nim tworzenie specjalnej, finalnej wersji kodu, która <br>
różniła się od wersji wykorzystywanej w codziennej pracy. Zazwyczaj wykorzystywano do tego celu narzędzia automatycznie usuwające komentarze <br>
w trakcie procesu generowania programu docelowego.</p>

<p>Umieszczaj komentarze blisko kodu, który opisują. Jedną z przesłanek, dla <br>
których prolog procedury nie powinien zawierać obszernej dokumentacji, <br>
jest to, że podejście takie prowadzi do znacznego oddalenia komentarzy od <br>
opisywanych przez nie części kodu. W trakcie konserwacji i rozbudowy programu komentarze odległe od modyfikowanych fragmentów są często ignorowane. Gdy komentarze i kod przestają być ze sobą zgodne, komentarze <br>
stają się bezużyteczne. Dużo lepiej przestrzegać Zasady Bliskości i umieszczać <br>
komentarze jak najbliżej kodu, który opisują. Zwiększa to prawdopodobieństwo, <br>
że pozostaną aktualne po zmianach, przez co zachowają swoją użyteczność. <br>
Poniżej opisuję kilka elementów prologu procedury. Należy je wprowadzać do <br>
kodu tylko wtedy, gdy są potrzebne. Nic nie stoi na przeszkodzie, aby utworzyć <br>
pewien standardowy szablon opisu procedury. Nie warto jednak trzymać się <br>
zasady, że każdy element tego szablonu musi zostać wykorzystany. Wykorzystaj <br>
elementy, które są potrzebne, po czym usuń pozostałe.</p>

<p>Opisuj procedury jednym – dwoma zdaniami w umieszczanym przed nimi <br>
komentarzu. Jeżeli nie jesteś w stanie opisać procedury w jednym lub dwóch <br>
krótkich zdaniach, to prawdopodobnie powinieneś poświęcić nieco czasu na <br>
zastanowienie się nad jej rolą w programie. Trudności w sformułowaniu krótkiego opisu są sygnałem, że projekt nie jest w pełni dopracowany. Oderwij się <br>
od pisania kodu i poświęć nieco czasu na poprawienie projektu.</p>

<p>Opisuj założenia interfejsu. Dokumentowanie założeń interfejsu można traktować jako uzupełnienie innych zasad pracy z komentarzami. Jeżeli budowa <br>
procedury opiera się na jakichkolwiek założeniach dotyczących stanu przekazywanych zmiennych — wartości dopuszczalne i niedopuszczalne, kolejność <br>
elementów tablic, zainicjalizowanie pewnych danych składowych czy to, że <br>
zawierają tylko poprawne dane — opisuj te założenia albo w prologu procedury, <br>
albo przy deklaracjach danych. Takich informacji w komentarzach wymaga <br>
praktycznie każda procedura. <br>
Dbaj też o informacje o wykorzystywanych danych globalnych. Zmienna globalna jest w równym stopniu elementem interfejsu procedury, co każda inna. <br>
Stwarza przy tym istotne zagrożenia, ponieważ nie zawsze jej globalny status <br>
jest wyraźnie widoczny. <br>
Gdy w trakcie pisania procedury zauważasz, że kod wykorzystuje pewne założenia dotyczące jej interfejsu, nie zwlekaj z zapisaniem tych założeń w komentarzach.</p>

<p>Opisuj globalne skutki wykonania procedury. Jeżeli procedura modyfikuje <br>
dane globalne, opisuj dokładnie, na czym polegają te modyfikacje. Jak pisałem <br>
w podrozdziale 13.3, „Dane globalne”, modyfikowanie danych globalnych <br>
jest przynajmniej o rząd wielkości bardziej niebezpieczne niż ich odczytywanie. <br>
Zmiany takie należy więc wprowadzać bardzo ostrożnie, a częścią tej ostrożności jest zapewnienie odpowiedniego opisu. Podobnie jak w innych sytuacjach, gdy pisanie takich opisów staje się uciążliwe, przepisz kod od postaw, <br>
redukując użycie zmiennych globalnych. <br>
Informuj o źródłach stosowanych algorytmów. Jeżeli używasz algorytmu opisanego w książce lub artykule, podaj tytuł książki lub artykułu i numer strony. <br>
Jeżeli napisałeś algorytm sam, zapewnij informację o tym, gdzie można znaleźć <br>
notatki dotyczące tego algorytmu.</p>

<p>Opisy klas <br>
Dla każdej klasy utwórz blok komentarza opisujący jej podstawowe atrybuty: <br>
Opisuj sposób projektowania klasy. Bardzo pomocne są komentarze ogólne, <br>
dostarczające informacji, których nie można w prosty sposób odtworzyć na <br>
podstawie kodu. Opisuj podejście przyjęte przy projektowaniu klasy, ogólną <br>
filozofię tego podejścia oraz rozważone i odrzucone alternatywy. <br>
Opisuj ograniczenia, założenia i inne podobne aspekty. Podobnie jak w przypadku procedur dbaj o opisy ograniczeń wynikających z projektu klasy. Opisuj <br>
też założenia dotyczące danych wejściowych i wyjściowych, schemat obsługi <br>
błędów, globalne skutki wykonywanych operacji, źródła algorytmów itd. <br>
Opisuj interfejs klasy. Czy inny programista będzie w stanie określić, jak używać klasy bez przeglądania jej implementacji? Jeżeli nie, hermetyzacja klasy <br>
jest zagrożona. Interfejs klasy powinien zawierać całość informacji niezbędnych do korzystania z tej klasy. Minimalny wymóg w konwencji Javadoc to  <br>
opisanie każdego parametru i każdej zwracanej wartości (Sun Microsystems 2000). Powinien on zostać spełniony dla każdej udostępnianej procedury <br>
(Bloch 2001). <br>
Nie opisuj w interfejsie klasy szczegółów implementacji. Podstawową zasadą <br>
hermetyzacji jest udostępnianie wyłącznie tych informacji, których udostęp- <br>
nienie jest konieczne. Jeżeli kwestia potrzeby ujawnienia pewnej informacji <br>
budzi wątpliwości, ogólną zasadą jest jej nieujawnianie. Pliki interfejsu klasy <br>
powinny zawierać informacje niezbędne do korzystania z tej klasy, ale nie <br>
informacje potrzebne do pracy z jej kodem.</p>

<p>W każdym pliku utwórz blok komentarza opisujący jego zawartość: <br>
Opisuj przeznaczenie i zawartość pliku. Komentarz nagłówkowy pliku powinien <br>
opisywać klasy lub procedury zawarte w tym pliku. Jeżeli w pliku znajdują się <br>
wszystkie procedury programu, przeznaczenie pliku jest dość oczywiste — <br>
jest to plik zawierający cały program. Jeżeli rolą pliku jest przechowywanie <br>
kodu klasy, jego przeznaczenie jest także oczywiste — jest to plik zawierający <br>
klasę o nazwie podobnej do nazwy pliku.</p>

<p>Zapisuj znacznik wersji. Wiele systemów kontroli wersji wstawia informację <br>
o wersji pliku automatycznie. Na przykład w CVS znaki <br>
// <script type="math/tex" id="MathJax-Element-1">Id</script> <br>
zostaną automatycznie zamienione na <br>
// <script type="math/tex" id="MathJax-Element-2">Id: ClassName.java,v 1.1 2004/02/05 00:36:43 ismena Exp </script> <br>
Zapewnia to obecność w pliku aktualnej informacji o wersji bez żadnej dodat- <br>
kowej pracy ze strony programistów poza wstawieniem na początku komen- <br>
tarza <script type="math/tex" id="MathJax-Element-3">Id</script> .</p>

<p>Zapisuj w bloku komentarza notę copyright. Wiele firm dba o to, aby w programach znajdowały się informacje o prawach autorskich, klauzule poufności <br>
plików i inne elementy natury prawnej. Jeżeli pracujesz w takiej firmie, umieść <br>
w pliku notę podobną do przedstawionej poniżej. Możesz też spytać doradcę <br>
prawnego firmy, jakie informacje powinny znaleźć się w plikach.</p></div></body>
</html>