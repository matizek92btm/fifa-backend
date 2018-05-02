<h1>Witaj {{$nick}} </h1>
<p>Otrzymaliśmy informację, że chciałbyś zmienić hasło. W tym celu prosimy kliknąć w link poniżej. 
<p>Prosimy o aktywację konta klikając w <a href={{route('users.password.change', ['token' => $token])}}>Zmiana hasła</a> 
<p>W sytuacji, gdybyś to nie Ty prosił o zmianę adresu email, prosimy o zingorowanie tej wiadomości i o natychmiastowy kontakt z administracją. </p>
<p>Pozdrawiamy,</p>
<p>Zespół FIFACLUB</p>