<?php
add_action('after_setup_theme',function(){add_theme_support('title-tag');add_theme_support('post-thumbnails');});
add_action('wp_enqueue_scripts',function(){
 wp_enqueue_style('intorrente-originale-bilingue',get_stylesheet_uri(),[],'32.0.0');
 wp_enqueue_script('intorrente-language',get_template_directory_uri().'/assets/js/language.js',[],'32.0.0',true);
});
function intorrente_planner_form($lang){
$it=$lang==='it';
$t=function($a,$b)use($it){return $it?$a:$b;};?>
<section class="wrap planner-layout"><form class="planner-card"><div class="planner-step"><span>1</span><b><?php echo $t('Territorio','Territory');?></b></div><label><?php echo $t('Destinazione','Destination');?><select><option>Valsesia - <?php echo $t('Piemonte','Piedmont');?></option></select></label><div class="planner-step"><span>2</span><b><?php echo $t('Quando','When');?></b></div><label><?php echo $t('Data','Date');?><input type="date"></label><div class="planner-step"><span>3</span><b><?php echo $t('Tecnica','Technique');?></b></div><div class="choice-grid"><label class="choice"><input type="radio" name="t-<?php echo $lang;?>"> <?php echo $t('Mosca','Fly fishing');?></label><label class="choice"><input type="radio" name="t-<?php echo $lang;?>"> Spinning</label><label class="choice"><input type="radio" name="t-<?php echo $lang;?>"> <?php echo $t('Tocco','Touch fishing');?></label></div><div class="planner-step"><span>4</span><b><?php echo $t('Livello','Level');?></b></div><select><option><?php echo $t('Facile','Easy');?></option><option><?php echo $t('Intermedio','Intermediate');?></option><option><?php echo $t('Avventuroso','Adventurous');?></option></select><div class="planner-step"><span>5</span><b><?php echo $t('Servizi extra','Extra services');?></b></div><div class="check-grid"><label><input type="checkbox"> <?php echo $t('Ospitalità','Hospitality');?></label><label><input type="checkbox"> <?php echo $t('Sapori locali','Local food');?></label><label><input type="checkbox"> <?php echo $t('Attrezzatura','Equipment');?></label><label><input type="checkbox"> <?php echo $t('Itinerari','Routes');?></label></div><div class="planner-step"><span>6</span><b><?php echo $t('Checklist: cosa portare','Checklist: what to bring');?></b></div><div class="gear-checklist"><h3><?php echo $t('Documenti e sicurezza','Documents and safety');?></h3><?php foreach([['Licenza e permessi','Licence and permits'],['Metro per misurare le catture','Tape measure for catches']] as $x)echo '<label><input type="checkbox"> '.$t($x[0],$x[1]).'</label>';?><h3><?php echo $t('Abbigliamento e accessori','Clothing and accessories');?></h3><?php foreach([['Waders','Waders'],['Scarponi da wading','Wading boots'],['K-way / mantella impermeabile','Rain jacket / waterproof cape'],['Stivali in gomma','Rubber boots']] as $x)echo '<label><input type="checkbox"> '.$t($x[0],$x[1]).'</label>';?><h3><?php echo $t('Attrezzatura da pesca','Fishing equipment');?></h3><?php foreach([['Esche e artificiali','Baits and lures'],['Mulinello / bobina con filo di diametro leggero','Reel / spool with light line'],['Mulinello / bobina con filo di diametro medio','Reel / spool with medium line'],['Mulinello / bobina con filo di diametro più robusto','Reel / spool with heavier line'],['Guadino','Landing net'],['Pinza / slamatore','Pliers / hook remover']] as $x)echo '<label><input type="checkbox"> '.$t($x[0],$x[1]).'</label>';?><h3><?php echo $t('Se è consentito trattenere il pescato','If keeping the catch is permitted');?></h3><?php foreach([['Zaino / contenitore termico','Insulated backpack / container'],['Blocchetti di ghiaccio','Ice packs']] as $x)echo '<label><input type="checkbox"> '.$t($x[0],$x[1]).'</label>';?><div class="custom-gear"><label><?php echo $t('Altri oggetti','Other items');?><input type="text"></label></div><p class="gear-warning"><?php echo $t('Verifica sempre se il trattenimento è consentito e quali limiti si applicano.','Always check whether keeping the catch is permitted and which limits apply.');?></p></div><div class="planner-actions"><button class="btn" type="button"><?php echo $t('CREA IL MIO PIANO','CREATE MY PLAN');?></button><button class="print-checklist" type="button" onclick="window.print()"><?php echo $t('STAMPA CHECKLIST','PRINT CHECKLIST');?></button></div></form><aside class="planner-side"><div class="planner-summary"><h2><?php echo $t('La tua battuta','Your fishing trip');?></h2><p><?php echo $t('Territorio','Territory');?>: Valsesia</p></div><div class="planner-note"><h2><?php echo $t('Prima di partire','Before you leave');?></h2><p><?php echo $t('Regolamenti, periodi di pesca, permessi, zone consentite e limiti di cattura possono variare. Verifica sempre le disposizioni aggiornate presso gli enti competenti prima dell’uscita.','Regulations, fishing seasons, permits, authorised areas and catch limits may vary. Always check current requirements with the competent authorities before your trip.');?></p></div></aside></section><?php }
function intorrente_v24_create_planner_page(){
  $page=get_page_by_path('pianifica-la-battuta');
  if(!$page){$id=wp_insert_post(['post_title'=>'Pianifica la Battuta','post_name'=>'pianifica-la-battuta','post_status'=>'publish','post_type'=>'page']);}
  else{$id=$page->ID;}
  if($id && !is_wp_error($id)){update_post_meta($id,'_wp_page_template','page-pianifica-la-battuta.php');}
  flush_rewrite_rules();
}
add_action('after_switch_theme','intorrente_v24_create_planner_page');
function intorrente_v26_create_techniques_page(){
 $p=get_page_by_path('tecniche');
 $id=$p?$p->ID:wp_insert_post(['post_title'=>'Tecniche di pesca','post_name'=>'tecniche','post_status'=>'publish','post_type'=>'page']);
 if($id&&!is_wp_error($id)){update_post_meta($id,'_wp_page_template','page-tecniche.php');}
 flush_rewrite_rules();
}
add_action('after_switch_theme','intorrente_v26_create_techniques_page');

/* V32 - Blocco Gutenberg visuale per allineare l'editor alla Home pubblicata. */
function intorrente_v32_defaults(){
 return [
  'heroTitleIt'=>'La pesca in torrente come stile di vita.','heroTitleEn'=>'Stream fishing as a way of life.',
  'heroTextIt'=>'Acque cristalline, paesaggi autentici, emozioni vere. Scopri, vivi, rispetta.','heroTextEn'=>'Crystal-clear waters, authentic landscapes, genuine experiences. Discover, experience, respect.',
  'heroClaimIt'=>'Dove la natura scorre più libera.','heroClaimEn'=>'Where nature flows more freely.',
  'planButtonIt'=>'PIANIFICA LA BATTUTA','planButtonEn'=>'PLAN YOUR TRIP','worldButtonIt'=>'SCOPRI IL NOSTRO MONDO','worldButtonEn'=>'DISCOVER OUR WORLD',
  'territoryTitleIt'=>'Scegli il tuo prossimo territorio','territoryTitleEn'=>'Choose your next territory',
  'territoryTextIt'=>'Ogni valle ha una storia da raccontare. Esplora i luoghi, i torrenti e pianifica la tua prossima avventura.','territoryTextEn'=>'Every valley has a story to tell. Explore its places and streams, then plan your next adventure.',
  'territoryButtonIt'=>'ESPLORA TUTTE LE DESTINAZIONI','territoryButtonEn'=>'EXPLORE ALL DESTINATIONS','destinationName'=>'VALSESIA','destinationPlace'=>'Piemonte, Italia',
  'featuredTitleIt'=>'In primo piano','featuredTitleEn'=>'Featured','footerMottoIt'=>'Più di una passione. Uno stile di vita.','footerMottoEn'=>'More than a passion. A way of life.'
 ];
}
function intorrente_v32_categories(){return [
 ['◆','TECNICHE','TECHNIQUES','Dalla mosca allo spinning, consigli e approfondimenti.','From fly fishing to spinning, advice and insights.','/tecniche/'],
 ['▣','ATTREZZATURA','EQUIPMENT','Le migliori scelte per ogni avventura.','The best choices for every adventure.','#'],
 ['⌁','ITINERARI','ROUTES','Torrenti, fiumi e percorsi da esplorare.','Streams, rivers and routes to explore.','#'],
 ['⌖','TERRITORI','TERRITORIES','Scegli la destinazione e lasciati ispirare.','Choose a destination and be inspired.','#'],
 ['⌂','OSPITALITÀ E SAPORI','HOSPITALITY & LOCAL FOOD','Dove dormire, cosa gustare, le tradizioni del territorio.','Where to stay, what to taste and local traditions.','#'],
 ['▤','BLOG','BLOG','Storie, esperienze e consigli utili.','Stories, experiences and useful advice.','/blog/'],
 ['▧','GALLERIA','GALLERY','Le più belle immagini dalle nostre acque.','The finest images from our waters.','/galleria/']
 ];}
function intorrente_v32_posts(){return [
 ['v12/featured-mosca.jpg','TECNICHE','TECHNIQUES','La pesca a mosca in torrente','Fly fishing in mountain streams','Eleganza, precisione e rispetto per il torrente.','Elegance, precision and respect for the stream.'],
 ['v12/featured-itinerario.jpg','ITINERARI','ROUTES','Val Sermenza: acque da scoprire','Val Sermenza: waters to discover','Torrenti cristallini tra natura incontaminata e panorami mozzafiato.','Crystal-clear streams, unspoilt nature and impressive landscapes.'],
 ['v12/featured-ospitalita.jpg','OSPITALITÀ E SAPORI','HOSPITALITY & LOCAL FOOD','Rifugi e sapori di montagna','Mountain lodges and local flavours','B&B, rifugi e piatti tipici per un’esperienza a tutto tondo.','B&Bs, mountain lodges and local food for a complete experience.'],
 ['v12/featured-attrezzatura.jpg','ATTREZZATURA','EQUIPMENT','Come scegliere la coda giusta','How to choose the right fly line','Guida pratica per affrontare ogni condizione di pesca.','A practical guide for different fishing conditions.']
 ];}
function intorrente_v32_attr($a,$name,$default){return isset($a[$name]) && $a[$name]!=='' ? $a[$name] : $default;}
function intorrente_v32_render_home($attributes){
 $d=intorrente_v32_defaults();$cats=intorrente_v32_categories();$posts=intorrente_v32_posts();$a=get_template_directory_uri().'/assets/images/';
 ob_start();?>
<div class="it15-home intorrente-home-block">
<section class="it15-hero"><div class="it15-wrap it15-hero-inner"><div class="it15-hero-copy"><h2><span data-it="<?php echo esc_attr(intorrente_v32_attr($attributes,'heroTitleIt',$d['heroTitleIt']));?>" data-en="<?php echo esc_attr(intorrente_v32_attr($attributes,'heroTitleEn',$d['heroTitleEn']));?>"><?php echo esc_html(intorrente_v32_attr($attributes,'heroTitleIt',$d['heroTitleIt']));?></span></h2><p><span data-it="<?php echo esc_attr(intorrente_v32_attr($attributes,'heroTextIt',$d['heroTextIt']));?>" data-en="<?php echo esc_attr(intorrente_v32_attr($attributes,'heroTextEn',$d['heroTextEn']));?>"><?php echo esc_html(intorrente_v32_attr($attributes,'heroTextIt',$d['heroTextIt']));?></span></p><div class="it15-actions"><a class="it15-primary" href="<?php echo esc_url(home_url('/pianifica-la-battuta/'));?>">▣ <?php echo esc_html(intorrente_v32_attr($attributes,'planButtonIt',$d['planButtonIt']));?> →</a><a class="it15-secondary" href="#it15-world"><?php echo esc_html(intorrente_v32_attr($attributes,'worldButtonIt',$d['worldButtonIt']));?> →</a></div></div><div class="it15-hand"><span data-it="<?php echo esc_attr(intorrente_v32_attr($attributes,'heroClaimIt',$d['heroClaimIt']));?>" data-en="<?php echo esc_attr(intorrente_v32_attr($attributes,'heroClaimEn',$d['heroClaimEn']));?>"><?php echo esc_html(intorrente_v32_attr($attributes,'heroClaimIt',$d['heroClaimIt']));?></span></div></div></section>
<section class="it15-cats" id="it15-world"><?php foreach($cats as $i=>$c){$n=$i+1;$ti=intorrente_v32_attr($attributes,"cat{$n}TitleIt",$c[1]);$te=intorrente_v32_attr($attributes,"cat{$n}TitleEn",$c[2]);$di=intorrente_v32_attr($attributes,"cat{$n}DescIt",$c[3]);$de=intorrente_v32_attr($attributes,"cat{$n}DescEn",$c[4]);?><a href="<?php echo esc_url($c[5]==='#'?'#':home_url($c[5]));?>"><i><?php echo esc_html($c[0]);?></i><b data-it="<?php echo esc_attr($ti);?>" data-en="<?php echo esc_attr($te);?>"><?php echo esc_html($ti);?></b><small data-it="<?php echo esc_attr($di);?>" data-en="<?php echo esc_attr($de);?>"><?php echo esc_html($di);?></small></a><?php }?></section>
<section class="it15-territory"><div class="it15-wrap it15-ter-grid"><div><h2><?php echo esc_html(intorrente_v32_attr($attributes,'territoryTitleIt',$d['territoryTitleIt']));?></h2><p><?php echo esc_html(intorrente_v32_attr($attributes,'territoryTextIt',$d['territoryTextIt']));?></p><a class="it15-primary" href="#"><?php echo esc_html(intorrente_v32_attr($attributes,'territoryButtonIt',$d['territoryButtonIt']));?> →</a></div><a class="it15-valsesia" href="#"><img src="<?php echo esc_url($a.'hero-home-clean.png');?>" alt="Valsesia"><span><b>⌖ <?php echo esc_html(intorrente_v32_attr($attributes,'destinationName',$d['destinationName']));?></b><small><?php echo esc_html(intorrente_v32_attr($attributes,'destinationPlace',$d['destinationPlace']));?></small></span><em>→</em></a><div class="it15-ter-spacer"></div></div></section>
<section class="it15-wrap it15-featured"><h2><?php echo esc_html(intorrente_v32_attr($attributes,'featuredTitleIt',$d['featuredTitleIt']));?></h2><div class="it15-posts"><?php foreach($posts as $i=>$p){$n=$i+1;$ci=intorrente_v32_attr($attributes,"post{$n}CatIt",$p[1]);$ti=intorrente_v32_attr($attributes,"post{$n}TitleIt",$p[3]);$di=intorrente_v32_attr($attributes,"post{$n}DescIt",$p[5]);?><article><div><img src="<?php echo esc_url($a.$p[0]);?>" alt=""><span><?php echo esc_html($ci);?></span></div><h3><?php echo esc_html($ti);?></h3><p><?php echo esc_html($di);?></p></article><?php }?></div></section>
<section class="it15-foot"><div class="it15-wrap"><div class="it15-foot-empty"></div><div class="it15-motto"><?php echo esc_html(intorrente_v32_attr($attributes,'footerMottoIt',$d['footerMottoIt']));?></div><div class="it15-foot-empty"></div></div></section>
</div><?php return ob_get_clean();
}
function intorrente_v32_register_block(){
 $attrs=[];foreach(intorrente_v32_defaults() as $k=>$v){$attrs[$k]=['type'=>'string','default'=>$v];}
 foreach(intorrente_v32_categories() as $i=>$c){$n=$i+1;$attrs["cat{$n}TitleIt"]=['type'=>'string','default'=>$c[1]];$attrs["cat{$n}TitleEn"]=['type'=>'string','default'=>$c[2]];$attrs["cat{$n}DescIt"]=['type'=>'string','default'=>$c[3]];$attrs["cat{$n}DescEn"]=['type'=>'string','default'=>$c[4]];}
 foreach(intorrente_v32_posts() as $i=>$p){$n=$i+1;$attrs["post{$n}CatIt"]=['type'=>'string','default'=>$p[1]];$attrs["post{$n}CatEn"]=['type'=>'string','default'=>$p[2]];$attrs["post{$n}TitleIt"]=['type'=>'string','default'=>$p[3]];$attrs["post{$n}TitleEn"]=['type'=>'string','default'=>$p[4]];$attrs["post{$n}DescIt"]=['type'=>'string','default'=>$p[5]];$attrs["post{$n}DescEn"]=['type'=>'string','default'=>$p[6]];}
 wp_register_script('intorrente-home-block',get_template_directory_uri().'/assets/blocks/home-block.js',['wp-blocks','wp-element','wp-components','wp-block-editor','wp-i18n'],'32.0.0',true);
 wp_localize_script('intorrente-home-block','intorrenteHomeBlock',['imagesUrl'=>get_template_directory_uri().'/assets/images/','categories'=>intorrente_v32_categories(),'posts'=>intorrente_v32_posts(),'attributes'=>$attrs]);
 wp_register_style('intorrente-home-editor',get_template_directory_uri().'/assets/blocks/home-editor.css',['wp-edit-blocks'],'32.0.0');
 register_block_type('intorrente/home',['api_version'=>2,'editor_script'=>'intorrente-home-block','editor_style'=>'intorrente-home-editor','attributes'=>$attrs,'render_callback'=>'intorrente_v32_render_home']);
}
add_action('init','intorrente_v32_register_block');
function intorrente_v32_setup_home(){
 $id=(int)get_option('page_on_front');$p=$id?get_post($id):get_page_by_path('home');
 if(!$p){$id=wp_insert_post(['post_title'=>'Home','post_name'=>'home','post_status'=>'publish','post_type'=>'page']);$p=get_post($id);}
 if($p && !has_block('intorrente/home',$p->post_content)){
  if(!get_post_meta($p->ID,'_intorrente_home_backup_v32',true))update_post_meta($p->ID,'_intorrente_home_backup_v32',$p->post_content);
  wp_update_post(['ID'=>$p->ID,'post_content'=>'<!-- wp:intorrente/home /-->']);
 }
 update_option('show_on_front','page');update_option('page_on_front',$p->ID);flush_rewrite_rules();
}
add_action('after_switch_theme','intorrente_v32_setup_home');

/* V37 - Tecniche e Pianifica come blocchi Gutenberg, senza metabox o pannelli aggiuntivi. */
function intorrente_v37_defaults($kind){
 if($kind==='techniques') return [
  'introIt'=>'Conosci, impara, pratica.','introEn'=>'Learn, understand, practise.',
  'subtitleIt'=>'Ogni tecnica un’emozione, ogni torrente una storia.','subtitleEn'=>'Every technique brings an experience, every stream tells a story.',
  'claimIt'=>'La tecnica è un modo di leggere il torrente.','claimEn'=>'Technique is a way of reading the stream.',
  'blogTitleIt'=>'Approfondisci e migliora la tua tecnica','blogTitleEn'=>'Learn more and improve your technique',
  'blogTextIt'=>'Guide, articoli e consigli pratici per diventare un pescatore più consapevole.','blogTextEn'=>'Guides, articles and practical advice to become a more aware angler.'
 ];
 return [
  'introIt'=>'Organizza la tua prossima esperienza di pesca in pochi semplici passaggi.','introEn'=>'Organise your next fishing experience in a few simple steps.',
  'claimIt'=>'Stessi torrenti. Nuove emozioni.','claimEn'=>'Same streams. New experiences.',
  'checkTitleIt'=>'Checklist: cosa portare','checkTitleEn'=>'Checklist: what to bring',
  'checkTextIt'=>'Spunta gli elementi utili per la tua battuta. Puoi anche aggiungere oggetti personali.','checkTextEn'=>'Select useful items for your trip. You can also add personal items.',
  'beforeTitleIt'=>'Prima di partire','beforeTitleEn'=>'Before you leave',
  'beforeTextIt'=>'Regolamenti, periodi di pesca, permessi, zone consentite e limiti di cattura possono variare. Verifica sempre le disposizioni aggiornate presso gli enti competenti prima dell’uscita.','beforeTextEn'=>'Regulations, fishing seasons, permits, authorised areas and catch limits may vary. Always check current requirements with the competent authorities before your trip.'
 ];
}
function intorrente_v37_register_blocks(){
 wp_register_script('intorrente-v37-blocks',get_template_directory_uri().'/assets/blocks/internal-blocks.js',['wp-blocks','wp-element','wp-block-editor','wp-components'],'37.0.0',true);
 wp_register_style('intorrente-v37-editor',get_template_directory_uri().'/assets/blocks/internal-editor.css',[], '37.0.0');
 foreach(['techniques','planner'] as $kind){$attrs=[];foreach(intorrente_v37_defaults($kind) as $k=>$v)$attrs[$k]=['type'=>'string','default'=>$v];register_block_type('intorrente/'.$kind,['api_version'=>2,'editor_script'=>'intorrente-v37-blocks','editor_style'=>'intorrente-v37-editor','attributes'=>$attrs,'render_callback'=>function(){return '';}]);}
}
add_action('init','intorrente_v37_register_blocks');
function intorrente_v37_attrs($kind){
 $defaults=intorrente_v37_defaults($kind);$post=get_post();if(!$post)return $defaults;
 $name='intorrente/'.$kind;foreach(parse_blocks($post->post_content) as $block)if(($block['blockName']??'')===$name)return array_merge($defaults,$block['attrs']??[]);
 return $defaults;
}
function intorrente_v37_value($kind,$key){$a=intorrente_v37_attrs($kind);return $a[$key]??'';}
function intorrente_v37_seed_blocks(){
 if(!is_admin()||!current_user_can('edit_pages'))return;
 $pages=get_posts(['post_type'=>'page','post_status'=>['publish','draft','private'],'numberposts'=>-1]);
 foreach($pages as $p){$tpl=get_page_template_slug($p->ID);$slug=$p->post_name;$kind='';
  if($tpl==='page-tecniche.php'||$slug==='tecniche'||$slug==='tecniche-di-pesca')$kind='techniques';
  if($tpl==='page-pianifica-la-battuta.php'||$slug==='pianifica-la-battuta')$kind='planner';
  if($kind&&!has_block('intorrente/'.$kind,$p->post_content)){wp_update_post(['ID'=>$p->ID,'post_content'=>'<!-- wp:intorrente/'.$kind.' /-->']);}
 }
}
add_action('admin_init','intorrente_v37_seed_blocks');
