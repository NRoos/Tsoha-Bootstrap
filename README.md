# Tietokantasovelluksen esittelysivu

Yleisiä linkkejä:

* [Linkki sovellukseeni](http://nroos.users.cs.helsinki.fi/tsoha/)
* [Linkki dokumentaatiooni](https://github.com/NRoos/Tsoha-Bootstrap/tree/master/doc/dokumentaatio.pdf)

## Työn aihe

* [Keskustelufoorumi](http://advancedkittenry.github.io/suunnittelu_ja_tyoymparisto/aiheet/Keskustelufoorumi.html) 

## Viikon 5 hommat

* logout löytyy sisäänkirjautuneelta käyttäjältä navigaatiopalkista (username: demo, pass: demo1)
* Dokumentaatiossa otettu huomioon vasta valmis toiminnallisuus
* Kirjautumisen varmennus näkyy lähinnä siinä että asioita ei voi poistaa ellei ole kirjautunut sisään
* CRUD on toteutettu kokonaisuudessaan sekä USR luokalle että Categories luokalle

## Lopullisen palautuksen huomiot

* Monesta-moneen yhteys on toteutettu UsrSeenTopic luokalla, eli kun käyttäjä avaa topicin jota ei ole ennen avannut, muodostuu välitaulu. Kun käyttäjä sitten menee omalle sivulleen, on siellä linkit jokaiseen hänen katsomaansa topicciin
* Topicit ja Replyt voi poistaa joko poistamalla niihin liittyvän käyttäjän tai Kategorian
* Replyillä ei ole omaa view sivua koska ne liittyvät aina topicciin ja ovat vastauksia sille

<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License</a>.
