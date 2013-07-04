<div style="margin-left:10px">	       <div class="topic">Edit Profile</div><?php
include 'db.php';
//	include 'demo.html';
session_start();
include 'changer.php';
if(isset($_GET['v']))
{
$v=$_GET['v'];
if($v==1)
{ ?>
<div class="desc_current"><a href="#!/editprofile?v=1">Basic</a></div>
<div class="desc_head"><a href="#!/editprofile?v=2">Social</a></div>
<div class="desc_head"><a href="#!/editprofile?v=3">Personal</a></div>
<div class="desc_head"><a href="#!/editprofile?v=4">Proffesional</a></div>
<div class="desc_head"><a href="#!/editprofile?v=5">Relations</a></div>
<div class="desc_head"><a href="#!/editprofile?v=6">Contact</a></div><br /><br />
<div class="profile_each"><div class="profile_main">Gender:</div>
<input type="radio" class="normcheck" id="gender0" name="gender" value="1"
/> <label for="gender0">female</label>&nbsp;&nbsp;
<input type="radio" class="normcheck" id="gender1" name="gender" value="2"
/> <label for="gender1">male</label> </div>
<div class="profile_each">
<div class="profile_main">Relationship status:</div>
<select id="status" name="status" style="width:181px"> 
<option value="0" ></option> 
<option value="1" >single</option> 
<option value="2" >married</option> 
<option value="3" >committed</option> 
<option value="4" >open marriage</option> 
<option value="5" >open relationship</option> 
</select>
</div>
<div class="profile_each">
<div class="profile_main">Birth day:</div>
<select id="birthMonth" name="birthMonth" style="width:71px"> 
<option value="0" >Jan</option> 
<option value="1" >Feb</option> 
<option value="2" >Mar</option> 
<option value="3" >Apr</option> 
<option value="4" >May</option> 
<option value="5" >June</option> 
<option value="6" >July</option> 
<option value="7" >Aug</option> 
<option value="8" >Sep</option> 
<option value="9" >Oct</option> 
<option value="10" >Nov</option> 
<option value="11">Dec</option> 
</select> 
<select id="birthDay" name="birthDay"> 
<?php 
for($i=1;$i<=31;$i++)
{
echo '<option value="'.$i.'">'.$i.'</option>';
}
?> 
</select> 
<select id="birthYear" name="birthYear"> 
<?php 
for($i=1998;$i>=1811;$i--)
{
echo '<option value="'.$i.'">'.$i.'</option>';
}
?>
</select>
</div><div class="profile_each">
<div class="profile_main">City: </div>
<input type="text" maxlength="40" size="24" name="city" id="city"/></div>
<div class="profile_each">
<div class="profile_main">State:</div>
<input type="text" maxlength="40" size="24" name="state" id="state"/> </div>
<div class="profile_each">
<div class="profile_main">Zip/Postal code:</div>
<input type="text" maxlength="8" size="24" name="postalCode" id="postalCode"/> 
</div><div class="profile_each">
<div class="profile_main">Country:</div>
<select id="country" name="country" onchange ="showChangeCountryAlert()" style="width:181px"> 
<option value="91">India</option> 
<option value="2" >Afghanistan</option> 
<option value="3" >Albania</option> 
<option value="4" >Algeria</option> 
<option value="5" >American Samoa</option> 
<option value="6" >Andorra</option> 
<option value="7" >Angola</option> 
<option value="8" >Anguilla</option> 
<option value="9" >Antigua and Barbuda</option> 
<option value="10" >Argentina</option> 
<option value="11" >Armenia</option> 
<option value="12" >Ascension Island</option> 
<option value="13" >Australia</option> 
<option value="14" >Austria</option> 
<option value="15" >Azerbaijan</option> 
<option value="16" >Bahamas</option> 
<option value="17" >Bahrain</option> 
<option value="18" >Bangladesh</option> 
<option value="19" >Barbados</option> 
<option value="20" >Belarus</option> 
<option value="21" >Belgium</option> 
<option value="22" >Belize</option> 
<option value="23" >Benin</option> 
<option value="24" >Bermuda</option> 
<option value="25" >Bhutan</option> 
<option value="26" >Bolivia</option> 
<option value="27" >Bosnia and Herzegovina</option> 
<option value="28" >Botswana</option> 
<option value="29" >Brazil</option>  
<option value="31" >Brunei Darussalam</option> 
<option value="32" >Bulgaria</option> 
<option value="33" >Burkina Faso</option> 
<option value="34" >Burundi</option> 
<option value="35" >Cambodia</option> 
<option value="36" >Cameroon</option> 
<option value="1" >Canada</option> 
<option value="37" >Cape Verde</option> 
<option value="38" >Cayman Islands</option> 
<option value="39" >Central African Republic</option> 
<option value="40" >Chad</option> 
<option value="41" >Chile</option> 
<option value="42" >China</option> 
<option value="43" >Colombia</option> 
<option value="44" >Comoros</option> 
<option value="45" >Congo</option> 
<option value="46" >Cook Islands</option> 
<option value="47" >Costa Rica</option> 
<option value="48" >Cote D Ivoire</option> 
<option value="49" >Croatia</option> 
<option value="50" >Cuba</option> 
<option value="51" >Cyprus</option> 
<option value="52" >Czech Republic</option> 
<option value="53" >Denmark</option> 
<option value="54" >Djibouti</option> 
<option value="55" >Dominica</option> 
<option value="56" >Dominican Republic</option> 
<option value="57" >Ecuador</option> 
<option value="58" >Egypt</option> 
<option value="59" >El Salvador</option> 
<option value="60" >Equatorial Guinea</option> 
<option value="61" >Eritrea</option> 
<option value="62" >Estonia</option> 
<option value="63" >Ethiopia</option> 
<option value="64" >Falkland Islands</option> 
<option value="65" >Faroe Islands</option> 
<option value="67" >Fiji</option> 
<option value="68" >Finland</option> 
<option value="69" >France</option> 
<option value="70" >French Guiana</option> 
<option value="71" >French Polynesia</option> 
<option value="72" >Gabon</option> 
<option value="73" >Georgia</option> 
<option value="74" >Germany</option> 
<option value="75" >Ghana</option> 
<option value="76" >Gibraltar</option> 
<option value="77" >Greece</option> 
<option value="78" >Greenland</option> 
<option value="79" >Grenada</option> 
<option value="80" >Guadeloupe</option> 
<option value="81" >Guam</option> 
<option value="82" >Guatemala</option> 
<option value="83" >Guinea</option> 
<option value="84" >Guinea Bissau</option> 
<option value="85" >Guyana</option> 
<option value="86" >Haiti</option> 
<option value="87" >Honduras</option> 
<option value="88" >Hong Kong</option> 
<option value="89" >Hungary</option> 
<option value="90" >Iceland</option> 
<option value="92" >Indonesia</option> 
<option value="93" >Iran</option> 
<option value="94" >Iraq</option> 
<option value="95" >Ireland</option> 
<option value="96" >Isle of Man</option> 
<option value="97" >Israel</option> 
<option value="98" >Italy</option> 
<option value="99" >Jamaica</option> 
<option value="100" >Japan</option> 
<option value="101" >Jordan</option> 
<option value="102" >Kazakhstan</option> 
<option value="103" >Kenya</option> 
<option value="104" >Kiribati</option> 
<option value="107" >Kuwait</option> 
<option value="108" >Kyrgyzstan</option> 
<option value="109" >Laos</option> 
<option value="110" >Latvia</option> 
<option value="111" >Lebanon</option> 
<option value="112" >Lesotho</option> 
<option value="113" >Liberia</option> 
<option value="114" >Libya</option> 
<option value="115" >Liechtenstein</option> 
<option value="116" >Lithuania</option> 
<option value="117" >Luxembourg</option> 
<option value="118" >Macau</option> 
<option value="119" >Macedonia</option> 
<option value="120" >Madagascar</option> 
<option value="121" >Malawi</option> 
<option value="122" >Malaysia</option> 
<option value="123" >Maldives</option> 
<option value="124" >Mali</option> 
<option value="125" >Malta</option> 
<option value="126" >Marshall Islands</option> 
<option value="127" >Martinique</option> 
<option value="128" >Mauritius</option> 
<option value="129" >Mayotte</option> 
<option value="130" >Mexico</option> 
<option value="131" >Moldova</option> 
<option value="132" >Monaco</option> 
<option value="133" >Mongolia</option> 
<option value="134" >Montenegro</option> 
<option value="135" >Montserrat</option> 
<option value="136" >Morocco</option> 
<option value="137" >Mozambique</option> 
<option value="138" >Myanmar</option> 
<option value="139" >Namibia</option> 
<option value="140" >Nauru</option> 
<option value="141" >Nepal</option> 
<option value="142" >Netherlands</option> 
<option value="143" >Netherlands Antilles</option> 
<option value="144" >New Caledonia</option> 
<option value="145" >New Zealand</option> 
<option value="146" >Nicaragua</option> 
<option value="147" >Niger</option> 
<option value="148" >Nigeria</option> 
<option value="149" >Niue</option> 
<option value="150" >Norfolk Island</option> 
<option value="152" >Norway</option> 
<option value="153" >Oman</option> 
<option value="154" >Pakistan</option> 
<option value="155" >Palau</option> 
<option value="156" >Panama</option> 
<option value="157" >Papua New Guinea</option> 
<option value="158" >Paraguay</option> 
<option value="159" >Peru</option> 
<option value="160" >Philippines</option> 
<option value="161" >Pitcairn</option> 
<option value="162" >Poland</option> 
<option value="163" >Portugal</option> 
<option value="164" >Puerto Rico</option> 
<option value="165" >Qatar</option> 
<option value="166" >Reunion</option> 
<option value="167" >Romania</option> 
<option value="168" >Russian Federation</option> 
<option value="169" >Rwanda</option> 
<option value="171" >San Marino</option> 
<option value="172" >Sao Tome and Principe</option> 
<option value="173" >Saudi Arabia</option> 
<option value="174" >Senegal</option> 
<option value="175" >Serbia</option> 
<option value="176" >Seychelles</option> 
<option value="177" >Sierra Leone</option> 
<option value="178" >Singapore</option> 
<option value="179" >Slovakia</option> 
<option value="180" >Slovenia</option> 
<option value="181" >Solomon Islands</option> 
<option value="182" >Somalia</option> 
<option value="183" >South Africa</option> 
<option value="184" >South Georgia</option> 
<option value="185" >Spain</option> 
<option value="186" >Sri Lanka</option> 
<option value="187" >St. Kitts and Nevis</option> 
<option value="188" >St. Lucia</option> 
<option value="190" >Sudan</option> 
<option value="191" >Suriname</option> 
<option value="192" >Swaziland</option> 
<option value="193" >Sweden</option> 
<option value="194" >Switzerland</option> 
<option value="195" >Syrian Arab Republic</option> 
<option value="196" >Taiwan</option> 
<option value="197" >Tajikistan</option> 
<option value="198" >Tanzania</option> 
<option value="199" >Thailand</option> 
<option value="200" >The Gambia</option> 
<option value="201" >Togo</option> 
<option value="202" >Tokelau</option> 
<option value="203" >Tonga</option> 
<option value="204" >Trinidad and Tobago</option> 
<option value="205" >Tunisia</option> 
<option value="206" >Turkey</option> 
<option value="207" >Turkmenistan</option>  
<option value="209" >Tuvalu</option> 
<option value="210" >Uganda</option> 
<option value="211" >Ukraine</option> 
<option value="212" >United Arab Emirates</option> 
<option value="213" >United Kingdom</option> 
<option value="0" >United States</option> 
<option value="214" >Uruguay</option> 
<option value="215" >Uzbekistan</option> 
<option value="216" >Vanuatu</option> 
<option value="217" >Venezuela</option> 
<option value="218" >Viet Nam</option> 
<option value="219" >Virgin Islands (U.K.)</option> 
<option value="220" >Virgin Islands (U.S.)</option> 
<option value="222" >Western Samoa</option> 
<option value="223" >Yemen</option> 
<option value="224" >Yugoslavia</option> 
<option value="226" >Zambia</option> 
<option value="227" >Zimbabwe</option> 
</select> 
<input type="hidden" id="countryIndex" value="-1"> 
<script type="text/javascript"> 
document.getElementById('countryIndex').value = document.getElementById('country').selectedIndex;
</script></div> 
<div class="profile_each">
<div class="profile_main">
Language I Speak:</div>
<select id="language1" name="language1"  style="width:181px"> 
<option value="0" ></option> 
<option value="2" >Afrikaans</option> 
<option value="3" >Ainu</option> 
<option value="4" >Albanian</option> 
<option value="117" >Amharic</option> 
<option value="5" >Amo</option> 
<option value="118" >Arabic</option> 
<option value="119" >Armenian</option> 
<option value="6" >Aymara</option> 
<option value="7" >Azerbaijani</option> 
<option value="8" >Azeri</option> 
<option value="9" >Bahasa</option> 
<option value="10" >Basque</option> 
<option value="11" >Batak</option> 
<option value="12" >Batak toba</option> 
<option value="120" >Belarusian</option> 
<option value="13" >Bengali</option> 
<option value="14" >Bihari</option> 
<option value="15" >Bosnian</option> 
<option value="16" >Breton</option> 
<option value="121" >Bulgarian</option> 
<option value="17" >Catalan</option> 
<option value="18" >Cherokee</option> 
<option value="122" >Chinese (Simplified)</option> 
<option value="123" >Chinese (Traditional)</option> 
<option value="19" >Cornish</option> 
<option value="20" >Corsican</option> 
<option value="21" >Cree</option> 
<option value="22" >Croatian</option> 
<option value="23" >Czech</option> 
<option value="24" >Danish</option> 
<option value="25" >Dutch</option> 
<option value="26" >Edo</option> 
<option value="152" >English (UK)</option> 
<option value="1">English (US)</option> 
<option value="27" >Esperanto</option> 
<option value="28" >Estonian</option> 
<option value="29" >Faroese</option> 
<option value="30" >Fijian</option> 
<option value="99" >Filipino</option> 
<option value="32" >Finnish</option> 
<option value="33" >French</option> 
<option value="34" >Frisian</option> 
<option value="35" >Gaelic</option> 
<option value="36" >Galician</option> 
<option value="37" >Gascon</option> 
<option value="124" >Georgian</option> 
<option value="38" >German</option> 
<option value="125" >Greek</option> 
<option value="39" >Guarani</option> 
<option value="126" >Gujarati</option> 
<option value="40" >Hanuno'o</option> 
<option value="41" >Hausa</option> 
<option value="42" >Hawaiian</option> 
<option value="127" >Hebrew</option> 
<option value="128" >Hindi</option> 
<option value="43" >Hmong</option> 
<option value="44" >Hopi</option> 
<option value="45" >Hungarian</option> 
<option value="46" >Ibibio</option> 
<option value="47" >Icelandic</option> 
<option value="48" >Indonesian</option> 
<option value="49" >Ingush</option> 
<option value="50" >Interlingua</option> 
<option value="51" >Inuktitut</option> 
<option value="52" >Inupiaq</option> 
<option value="53" >Irish</option> 
<option value="54" >Italian</option> 
<option value="129" >Japanese</option> 
<option value="55" >Javanese</option> 
<option value="56" >Kannada</option> 
<option value="57" >Kanuri</option> 
<option value="58" >Karelian</option> 
<option value="59" >Khasi</option> 
<option value="60" >Kirghiz</option> 
<option value="61" >Komi</option> 
<option value="130" >Korean</option> 
<option value="62" >Kurdish</option> 
<option value="131" >Kyrgyz</option> 
<option value="132" >Laothian</option> 
<option value="63" >Lapp</option> 
<option value="64" >Latin</option> 
<option value="65" >Latvian</option> 
<option value="66" >Lithuanian</option> 
<option value="67" >Lushootseed</option> 
<option value="68" >Luxemburgish</option> 
<option value="69" >Macedonian</option> 
<option value="70" >Malay</option> 
<option value="133" >Malayalam</option> 
<option value="71" >Maltese</option> 
<option value="134" >Marathi</option> 
<option value="72" >Mari</option> 
<option value="135" >Mongolian</option> 
<option value="73" >Naga</option> 
<option value="74" >Navajo</option> 
<option value="136" >Nepali</option> 
<option value="75" >Norwegian</option> 
<option value="137" >Norwegian (Nynorsk)</option> 
<option value="76" >Occitan</option> 
<option value="77" >Oriya</option> 
<option value="150" >Pashto</option> 
<option value="138" >Persian</option> 
<option value="78" >Polish</option> 
<option value="79" >Portuguese (Brazil)</option> 
<option value="153" >Portuguese (Portugal)</option> 
<option value="80" >Provencal</option> 
<option value="81" >Prussian</option> 
<option value="82" >Punjabi</option> 
<option value="83" >Quechua</option> 
<option value="84" >Romanian</option> 
<option value="139" >Romansh</option> 
<option value="85" >Romany</option> 
<option value="140" >Russian</option> 
<option value="86" >Sami</option> 
<option value="87" >Scots Gaelic</option> 
<option value="141" >Serbian</option> 
<option value="88" >Serbo-Croatian</option> 
<option value="89" >Sesotho</option> 
<option value="90" >Shona</option> 
<option value="142" >Sindhi</option> 
<option value="91" >Sinhalese</option> 
<option value="92" >Slovak</option> 
<option value="93" >Slovenian</option> 
<option value="94" >Somali</option> 
<option value="95" >Spanish</option> 
<option value="154" >Spanish (Latin America)</option> 
<option value="96" >Sudanese</option> 
<option value="97" >Swahili</option> 
<option value="98" >Swedish</option> 
<option value="100" >Tagbanwa</option> 
<option value="101" >Tahitian</option> 
<option value="102" >Tajik</option> 
<option value="103" >Tamazight</option> 
<option value="143" >Tamil</option> 
<option value="144" >Telugu</option> 
<option value="145" >Thai</option> 
<option value="146" >Tigrinya</option> 
<option value="104" >Turkish</option> 
<option value="105" >Turkmen</option> 
<option value="106" >Twi</option> 
<option value="107" >Udmurt</option> 
<option value="108" >Uighur</option> 
<option value="147" >Ukrainian</option> 
<option value="148" >Urdu</option> 
<option value="109" >Uzbek</option> 
<option value="110" >Vietnamese</option> 
<option value="111" >Welsh</option> 
<option value="112" >Xhosa</option> 
<option value="113" >Yi</option> 
<option value="149" >Yiddish</option> 
<option value="114" >Yoruba</option> 
<option value="115" >Zulu</option> 
</select></div>   
<div class="profile_each">
<div class="profile_main">University:</div>
<input type="text" maxlength="50" size="24" name="education.1.school" id="education.1.school"/></div> 
<div class="profile_each">
<div class="profile_main">Company/Organization: </div>
<input type="text" maxlength="50" size="24" name="company" id="company" value=""/>
</div>
<?php
}
if($v==2)
{ 
?>  
<div class="desc_head"><a href="#!/editprofile?v=1">Basic</a></div>
<div class="desc_current"><a href="#!/editprofile?v=2">Social</a></div>
<div class="desc_head"><a href="#!/editprofile?v=3">Personal</a></div>
<div class="desc_head"><a href="#!/editprofile?v=4">Proffesional</a></div>
<div class="desc_head"><a href="#!/editprofile?v=5">Relations</a></div>
<div class="desc_head"><a href="#!/editprofile?v=6">Contact</a></div><br /><br />

<div class="profile_each">
<div class="profile_main">Children:</div> 
<select id="kids" name="kids" style="width:181px"> 
<option value="0" ></option> 
<option value="1" >no</option> 
<option value="2" >yes - at home full time</option> 
<option value="3" >yes - at home part time</option> 
<option value="4" >yes - not at home</option> 
</select></div> 
<div class="profile_each">
<div class="profile_main">Religion:</div>
<select id="religion" name="religion" style="width:181px"> 
<option value="0" ></option> 
<option value="1" >Agnostic</option> 
<option value="2" >Atheist</option> 
<option value="16" >Baha'i</option> 
<option value="3" >Buddhist</option> 
<option value="19" >Cao Dai</option> 
<option value="26" >Christian/Anglican</option> 
<option value="4" >Christian/Catholic</option> 
<option value="5" >Christian/LDS</option> 
<option value="27" >Christian/Orthodox</option> 
<option value="7" >Christian/Other</option> 
<option value="6" >Christian/Protestant</option> 
<option value="8" >Hindu</option> 
<option value="17" >Jain</option> 
<option value="9" >Jewish</option> 
<option value="10" >Muslim</option> 
<option value="21" >Neo-Paganist</option> 
<option value="23" >Rastafarian</option> 
<option value="12" >Religious humanist</option> 
<option value="24" >Scientologist</option> 
<option value="18" >Shinto</option> 
<option value="15" >Sikh</option> 
<option value="11" >Spiritual but not religious</option> 
<option value="25" >Taoist</option> 
<option value="20" >Tenrikyo</option> 
<option value="22" >Unitarian Universalist</option> 
<option value="14" >Zoroastrian</option> 
<option value="13" >other</option> 
</select></div> 
<div class="profile_each">
<div class="profile_main">Political view:</div>
<select id="political" name="political" style="width:181px"> 
<option value="0" ></option> 
<option value="1" >right-conservative</option> 
<option value="2" >very right-conservative</option> 
<option value="3" >centrist</option> 
<option value="4" >left-liberal</option> 
<option value="5" >very left-liberal</option> 
<option value="6" >libertarian</option> 
<option value="7" >very libertarian</option> 
<option value="8" >authoritarian</option> 
<option value="9" >very authoritarian</option> 
<option value="10" >depends</option> 
<option value="11" >not political</option> 
</select> </div>
<div class="profile_each">
<div class="profile_main">Sexual Orientation:</div>
<select id="sexPref" name="sexPref" style="width:181px"> 
<option value="0" selected="selected"></option> 
<option value="1" >straight</option> 
<option value="2" >gay</option> 
<option value="3" >bisexual</option> 
<option value="4" >bi-curious</option> 
</select></div>  
<div class="profile_each">
<div class="profile_main">Smoking:</div>  
<select id="smoking" name="smoking" style="width:181px"> 
<option value="0" ></option> 
<option value="1" >no</option> 
<option value="2" >socially</option> 
<option value="3" >occasionally</option> 
<option value="4" >regularly</option> 
<option value="5" >heavily</option> 
<option value="6" >trying to quit</option> 
<option value="7" >quit</option> 
</select></div> 
<div class="profile_each">
<div class="profile_main">Drinking:</div> 
<select id="drinking" name="drinking" style="width:181px"> 
<option value="0" ></option> 
<option value="1"  >no</option> 
<option value="2" >socially</option> 
<option value="3" >occasionally</option> 
<option value="4" >regularly</option> 
<option value="5" >heavily</option> 
</select> </div>
<div class="profile_each">
<div class="profile_main">Pets:</div>
<select id="pets" name="pets" style="width:181px"> 
<option value="0" ></option> 
<option value="1" >i love my pet(s)</option> 
<option value="2" >i like them at the zoos</option> 
<option value="3">i like pet(s)</option> 
<option value="4" >i don't like pets</option> 
</select> </div>
<div class="profile_each">
<div class="profile_main">Hometown:</div>
<input type="text" maxlength="50" size="24" name="hometown" id="hometown"/> </div>
<div class="profile_each">
<div class="profile_main">Webpage:</div>
<input type="text" maxlength="60" size="24" name="webpageUrl" id="webpageUrl" value="" onBlur="setTimeout(function(){_showValidationError(this,_validateUrl(form.webpageUrl))}, 150);"/></div> 
<div class="profile_each">
<div class="profile_main">About me:</div>
<textarea name="aboutMe" id="aboutMe" rows="4" onKeyPress="_enforceLength(this,4096);" cols="36" ></textarea> </div>
<div class="profile_each">
<div class="profile_main">Passions:</div>
<textarea name="passions" id="passions" rows="3" onKeyPress="_enforceLength(this,1024);" cols="36" ></textarea></div> 
<div class="profile_each">
<div class="profile_main">Sports:</div> 
<textarea name="sports" id="sports" rows="3" onKeyPress="_enforceLength(this,1024);" cols="36" ></textarea></div> 
<div class="profile_each">
<div class="profile_main">Activities: </div>
<textarea name="activities" id="activities" rows="3" onKeyPress="_enforceLength(this,1024);" cols="36" ></textarea> </div>
<div class="profile_each">
<div class="profile_main">Books:</div>
<textarea name="books" id="books" rows="3" onKeyPress="_enforceLength(this,1024);" cols="36" ></textarea></div> 
<div class="profile_each">
<div class="profile_main">Music:</div>
<textarea name="music" id="music" rows="3" onKeyPress="_enforceLength(this,1024);" cols="36" ></textarea></div> 
<div class="profile_each">
<div class="profile_main">TV shows:</div> 
<textarea name="shows" id="shows" rows="3" onKeyPress="_enforceLength(this,1024);" cols="36" ></textarea></div> 
<div class="profile_each">
<div class="profile_main">Movies:</div>
<textarea name="movies" id="movies" rows="3" onKeyPress="_enforceLength(this,1024);" cols="36" ></textarea></div> 
<div class="profile_each">
<div class="profile_main">Cuisines:</div>
<textarea name="cuisines" id="cuisines" rows="3" onKeyPress="_enforceLength(this,1024);" cols="36" ></textarea></div>
<?php
}
if($v==3)
{ ?> 
<div class="desc_head"><a href="#!/editprofile?v=1">Basic</a></div>
<div class="desc_head"><a href="#!/editprofile?v=2">Social</a></div>
<div class="desc_current"><a href="#!/editprofile?v=3">Personal</a></div>
<div class="desc_head"><a href="#!/editprofile?v=4">Proffesional</a></div>
<div class="desc_head"><a href="#!/editprofile?v=5">Relations</a></div>
<div class="desc_head"><a href="#!/editprofile?v=6">Contact</a></div><br /><br />
<?php
}
if($v==4)
{ ?> 
<div class="desc_head"><a href="#!/editprofile?v=1">Basic</a></div>
<div class="desc_head"><a href="#!/editprofile?v=2">Social</a></div>
<div class="desc_head"><a href="#!/editprofile?v=3">Personal</a></div>
<div class="desc_current"><a href="#!/editprofile?v=4">Proffesional</a></div>
<div class="desc_head"><a href="#!/editprofile?v=5">Relations</a></div>
<div class="desc_head"><a href="#!/editprofile?v=6">Contact</a></div><br /><br />
<?php
}if($v==5)
{ ?>
<div class="desc_head"><a href="#!/editprofile?v=1">Basic</a></div>
<div class="desc_head"><a href="#!/editprofile?v=2">Social</a></div>
<div class="desc_head"><a href="#!/editprofile?v=3">Personal</a></div>
<div class="desc_head"><a href="#!/editprofile?v=4">Proffesional</a></div>
<div class="desc_current"><a href="#!/editprofile?v=5">Relations</a></div>
<div class="desc_head"><a href="#!/editprofile?v=6">Contact</a></div><br /><br />
<?php
}if($v==6)
{ ?>
<div class="desc_head"><a href="#!/editprofile?v=1">Basic</a></div>
<div class="desc_head"><a href="#!/editprofile?v=2">Social</a></div>
<div class="desc_head"><a href="#!/editprofile?v=3">Personal</a></div>
<div class="desc_head"><a href="#!/editprofile?v=4">Proffesional</a></div>
<div class="desc_head"><a href="#!/editprofile?v=5">Relations</a></div>
<div class="desc_current"><a href="#!/editprofile?v=6">Contact</a></div><br /><br />
<?php 
}
}
?>
</div>