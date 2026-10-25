(function(wp){
var el=wp.element.createElement,Fragment=wp.element.Fragment;
var TextControl=wp.components.TextControl,TextareaControl=wp.components.TextareaControl,PanelBody=wp.components.PanelBody;
var InspectorControls=wp.blockEditor.InspectorControls,RichText=wp.blockEditor.RichText;
var data=window.intorrenteHomeBlock||{},cats=data.categories||[],posts=data.posts||[],img=data.imagesUrl||'';
function field(label,key,a,set,multi){var C=multi?TextareaControl:TextControl;return el(C,{label:label,value:a[key]||'',onChange:function(v){var o={};o[key]=v;set(o);}});}
wp.blocks.registerBlockType('intorrente/home',{apiVersion:2,title:'Home inTorrente',icon:'admin-site-alt3',category:'design',description:'Anteprima reale e modificabile della Home inTorrente.',attributes:data.attributes||{},edit:function(p){var a=p.attributes,set=p.setAttributes;
var inspector=el(InspectorControls,null,
 el(PanelBody,{title:'Hero IT / EN',initialOpen:true},field('Titolo IT','heroTitleIt',a,set),field('Titolo EN','heroTitleEn',a,set),field('Descrizione IT','heroTextIt',a,set,true),field('Descrizione EN','heroTextEn',a,set,true),field('Claim IT','heroClaimIt',a,set),field('Claim EN','heroClaimEn',a,set),field('Pulsante Pianifica IT','planButtonIt',a,set),field('Pulsante Pianifica EN','planButtonEn',a,set)),
 el(PanelBody,{title:'Territorio IT / EN',initialOpen:false},field('Titolo IT','territoryTitleIt',a,set),field('Titolo EN','territoryTitleEn',a,set),field('Descrizione IT','territoryTextIt',a,set,true),field('Descrizione EN','territoryTextEn',a,set,true),field('Destinazione','destinationName',a,set),field('Località','destinationPlace',a,set)),
 el(PanelBody,{title:'Motto finale IT / EN',initialOpen:false},field('Italiano','footerMottoIt',a,set),field('Inglese','footerMottoEn',a,set))
);
var catEls=cats.map(function(c,i){var n=i+1;return el('div',{className:'ith-editor-cat',key:n},el('i',null,c[0]),el(RichText,{tagName:'b',value:a['cat'+n+'TitleIt']||c[1],onChange:function(v){var o={};o['cat'+n+'TitleIt']=v;set(o);}}),el(RichText,{tagName:'small',value:a['cat'+n+'DescIt']||c[3],onChange:function(v){var o={};o['cat'+n+'DescIt']=v;set(o);}}));});
var postEls=posts.map(function(x,i){var n=i+1;return el('article',{key:n},el('div',{className:'ith-editor-image'},el('img',{src:img+x[0]}),el(RichText,{tagName:'span',value:a['post'+n+'CatIt']||x[1],onChange:function(v){var o={};o['post'+n+'CatIt']=v;set(o);}})),el(RichText,{tagName:'h3',value:a['post'+n+'TitleIt']||x[3],onChange:function(v){var o={};o['post'+n+'TitleIt']=v;set(o);}}),el(RichText,{tagName:'p',value:a['post'+n+'DescIt']||x[5],onChange:function(v){var o={};o['post'+n+'DescIt']=v;set(o);}}));});
return el(Fragment,null,inspector,el('div',{className:'ith-editor-home'},
 el('div',{className:'ith-editor-note'},'Anteprima Home reale. Seleziona un testo per modificarlo; le versioni inglesi sono nel pannello laterale.'),
 el('section',{className:'ith-editor-hero'},el('div',{className:'ith-editor-copy'},el(RichText,{tagName:'h2',value:a.heroTitleIt,onChange:function(v){set({heroTitleIt:v});}}),el(RichText,{tagName:'p',value:a.heroTextIt,onChange:function(v){set({heroTextIt:v});}}),el('div',{className:'ith-editor-buttons'},'▣ '+(a.planButtonIt||'PIANIFICA LA BATTUTA')+'   |   '+(a.worldButtonIt||'SCOPRI IL NOSTRO MONDO'))),el(RichText,{tagName:'div',className:'ith-editor-hand',value:a.heroClaimIt,onChange:function(v){set({heroClaimIt:v});}})),
 el('section',{className:'ith-editor-cats'},catEls),
 el('section',{className:'ith-editor-territory'},el('div',null,el(RichText,{tagName:'h2',value:a.territoryTitleIt,onChange:function(v){set({territoryTitleIt:v});}}),el(RichText,{tagName:'p',value:a.territoryTextIt,onChange:function(v){set({territoryTextIt:v});}})),el('div',{className:'ith-editor-destination'},el(RichText,{tagName:'b',value:a.destinationName,onChange:function(v){set({destinationName:v});}}),el(RichText,{tagName:'small',value:a.destinationPlace,onChange:function(v){set({destinationPlace:v});}}))),
 el('section',{className:'ith-editor-featured'},el(RichText,{tagName:'h2',value:a.featuredTitleIt,onChange:function(v){set({featuredTitleIt:v});}}),el('div',{className:'ith-editor-posts'},postEls)),
 el(RichText,{tagName:'section',className:'ith-editor-motto',value:a.footerMottoIt,onChange:function(v){set({footerMottoIt:v});}})
));},save:function(){return null;}});
})(window.wp);
