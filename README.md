##Phrygia Framework
====================================

##Installation

####Hämta
Du kan ladda ner Phrygia från https://github.com/vfarias/phrygia eller genom kommandot <code>git clone https://github.com/vfarias/phrygia.git</code>

####Installera
Om du inte lägger Phrygia i root behöver du ändra .htaccess. Detta är en dold fil i huvudkatalogen. Raden du behöver ändra är 
<code># RewriteBase /~redirect/to/your/desired/directory/</code> till det directory som du använder.

Du behöver också göra katalogen site/data skrivbar. Detta kan göras genom Filezilla eller med kommandot: <code>cd phrygia chmod 777 site/data</code>

Slutligen behöver modulerna initieras. Detta görs genom att gå till phrygia/module/install. Alternativt kan du gå till phrygia/home och klicka på länken längst ner på sidan.
Två användare ska

##Utseende
Header, footer, slogan, logo, navigeringsmenyer och favicon kan alla ändras i 'data' under <code>$phr->config['theme']</code>. 
Du finner detta i phrygia/site/config.php, med början på rad 133. Enheten för logo_width och logo_height är pixlar.
Du kan också modifiera navigeringsmenyerna under <code>$phr->config['menus']</code>, som börjar på rad 94 i samma fil.
Slutligen kan du ändra CSS i phrygia/site/themes/mytheme/style.css. I mytheme lägger du även de bilder du vill använda som logo och favicon.


##Innehåll
####Blog
För att skapa en sida eller ett bloginlägg behöver du peka webläsaren mot content/create (kan per default nås via navigeringsmenyn om du är inloggad som admin).
För sidor skriv in page i type-fältet. För bloginlägg skriv post. I filter kan du välja mellan plain (default-värde), bbcode och htmlpurify.


##Åtkomst och administration
####Begränsa åtkomst
Åtkomst till controllers hanteras av [code]$phr->config['controllers'][/code] på rad 65 i config.php. 
Genom att lägga in akronymen för en grupp i enabled, får alla medlemmar i gruppen tillgång till controllern.

####Admin Controller
Om du loggar in som administratör finns en acp-länk i din login-meny som leder till det administrativa gränssnittet. 
För admins visas också en andra navigeringsmeny där den första länken, Control Panel, leder till samma sida.
I ACP har du en lista på alla användare och grupper. Du kan också ändra information, skapa nya grupper och radera grupper och anv 
