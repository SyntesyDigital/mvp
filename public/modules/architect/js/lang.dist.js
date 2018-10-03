/*!
 *  Lang.js for Laravel localization in JavaScript.
 *
 *  @version 1.1.10
 *  @license MIT https://github.com/rmariuzzo/Lang.js/blob/master/LICENSE
 *  @site    https://github.com/rmariuzzo/Lang.js
 *  @author  Rubens Mariuzzo <rubens@mariuzzo.com>
 */
(function(root,factory){"use strict";if(typeof define==="function"&&define.amd){define([],factory)}else if(typeof exports==="object"){module.exports=factory()}else{root.Lang=factory()}})(this,function(){"use strict";function inferLocale(){if(typeof document!=="undefined"&&document.documentElement){return document.documentElement.lang}}function convertNumber(str){if(str==="-Inf"){return-Infinity}else if(str==="+Inf"||str==="Inf"||str==="*"){return Infinity}return parseInt(str,10)}var intervalRegexp=/^({\s*(\-?\d+(\.\d+)?[\s*,\s*\-?\d+(\.\d+)?]*)\s*})|([\[\]])\s*(-Inf|\*|\-?\d+(\.\d+)?)\s*,\s*(\+?Inf|\*|\-?\d+(\.\d+)?)\s*([\[\]])$/;var anyIntervalRegexp=/({\s*(\-?\d+(\.\d+)?[\s*,\s*\-?\d+(\.\d+)?]*)\s*})|([\[\]])\s*(-Inf|\*|\-?\d+(\.\d+)?)\s*,\s*(\+?Inf|\*|\-?\d+(\.\d+)?)\s*([\[\]])/;var defaults={locale:"en"};var Lang=function(options){options=options||{};this.locale=options.locale||inferLocale()||defaults.locale;this.fallback=options.fallback;this.messages=options.messages};Lang.prototype.setMessages=function(messages){this.messages=messages};Lang.prototype.getLocale=function(){return this.locale||this.fallback};Lang.prototype.setLocale=function(locale){this.locale=locale};Lang.prototype.getFallback=function(){return this.fallback};Lang.prototype.setFallback=function(fallback){this.fallback=fallback};Lang.prototype.has=function(key,locale){if(typeof key!=="string"||!this.messages){return false}return this._getMessage(key,locale)!==null};Lang.prototype.get=function(key,replacements,locale){if(!this.has(key,locale)){return key}var message=this._getMessage(key,locale);if(message===null){return key}if(replacements){message=this._applyReplacements(message,replacements)}return message};Lang.prototype.trans=function(key,replacements){return this.get(key,replacements)};Lang.prototype.choice=function(key,number,replacements,locale){replacements=typeof replacements!=="undefined"?replacements:{};replacements.count=number;var message=this.get(key,replacements,locale);if(message===null||message===undefined){return message}var messageParts=message.split("|");var explicitRules=[];for(var i=0;i<messageParts.length;i++){messageParts[i]=messageParts[i].trim();if(anyIntervalRegexp.test(messageParts[i])){var messageSpaceSplit=messageParts[i].split(/\s/);explicitRules.push(messageSpaceSplit.shift());messageParts[i]=messageSpaceSplit.join(" ")}}if(messageParts.length===1){return message}for(var j=0;j<explicitRules.length;j++){if(this._testInterval(number,explicitRules[j])){return messageParts[j]}}var pluralForm=this._getPluralForm(number);return messageParts[pluralForm]};Lang.prototype.transChoice=function(key,count,replacements){return this.choice(key,count,replacements)};Lang.prototype._parseKey=function(key,locale){if(typeof key!=="string"||typeof locale!=="string"){return null}var segments=key.split(".");var source=segments[0].replace(/\//g,".");return{source:locale+"."+source,sourceFallback:this.getFallback()+"."+source,entries:segments.slice(1)}};Lang.prototype._getMessage=function(key,locale){locale=locale||this.getLocale();key=this._parseKey(key,locale);if(this.messages[key.source]===undefined&&this.messages[key.sourceFallback]===undefined){return null}var message=this.messages[key.source];var entries=key.entries.slice();var subKey="";while(entries.length&&message!==undefined){var subKey=!subKey?entries.shift():subKey.concat(".",entries.shift());if(message[subKey]!==undefined){message=message[subKey];subKey=""}}if(typeof message!=="string"&&this.messages[key.sourceFallback]){message=this.messages[key.sourceFallback];entries=key.entries.slice();subKey="";while(entries.length&&message!==undefined){var subKey=!subKey?entries.shift():subKey.concat(".",entries.shift());if(message[subKey]){message=message[subKey];subKey=""}}}if(typeof message!=="string"){return null}return message};Lang.prototype._findMessageInTree=function(pathSegments,tree){while(pathSegments.length&&tree!==undefined){var dottedKey=pathSegments.join(".");if(tree[dottedKey]){tree=tree[dottedKey];break}tree=tree[pathSegments.shift()]}return tree};Lang.prototype._applyReplacements=function(message,replacements){for(var replace in replacements){message=message.replace(new RegExp(":"+replace,"gi"),function(match){var value=replacements[replace];var allCaps=match===match.toUpperCase();if(allCaps){return value.toUpperCase()}var firstCap=match===match.replace(/\w/i,function(letter){return letter.toUpperCase()});if(firstCap){return value.charAt(0).toUpperCase()+value.slice(1)}return value})}return message};Lang.prototype._testInterval=function(count,interval){if(typeof interval!=="string"){throw"Invalid interval: should be a string."}interval=interval.trim();var matches=interval.match(intervalRegexp);if(!matches){throw"Invalid interval: "+interval}if(matches[2]){var items=matches[2].split(",");for(var i=0;i<items.length;i++){if(parseInt(items[i],10)===count){return true}}}else{matches=matches.filter(function(match){return!!match});var leftDelimiter=matches[1];var leftNumber=convertNumber(matches[2]);if(leftNumber===Infinity){leftNumber=-Infinity}var rightNumber=convertNumber(matches[3]);var rightDelimiter=matches[4];return(leftDelimiter==="["?count>=leftNumber:count>leftNumber)&&(rightDelimiter==="]"?count<=rightNumber:count<rightNumber)}return false};Lang.prototype._getPluralForm=function(count){switch(this.locale){case"az":case"bo":case"dz":case"id":case"ja":case"jv":case"ka":case"km":case"kn":case"ko":case"ms":case"th":case"tr":case"vi":case"zh":return 0;case"af":case"bn":case"bg":case"ca":case"da":case"de":case"el":case"en":case"eo":case"es":case"et":case"eu":case"fa":case"fi":case"fo":case"fur":case"fy":case"gl":case"gu":case"ha":case"he":case"hu":case"is":case"it":case"ku":case"lb":case"ml":case"mn":case"mr":case"nah":case"nb":case"ne":case"nl":case"nn":case"no":case"om":case"or":case"pa":case"pap":case"ps":case"pt":case"so":case"sq":case"sv":case"sw":case"ta":case"te":case"tk":case"ur":case"zu":return count==1?0:1;case"am":case"bh":case"fil":case"fr":case"gun":case"hi":case"hy":case"ln":case"mg":case"nso":case"xbr":case"ti":case"wa":return count===0||count===1?0:1;case"be":case"bs":case"hr":case"ru":case"sr":case"uk":return count%10==1&&count%100!=11?0:count%10>=2&&count%10<=4&&(count%100<10||count%100>=20)?1:2;case"cs":case"sk":return count==1?0:count>=2&&count<=4?1:2;case"ga":return count==1?0:count==2?1:2;case"lt":return count%10==1&&count%100!=11?0:count%10>=2&&(count%100<10||count%100>=20)?1:2;case"sl":return count%100==1?0:count%100==2?1:count%100==3||count%100==4?2:3;case"mk":return count%10==1?0:1;case"mt":return count==1?0:count===0||count%100>1&&count%100<11?1:count%100>10&&count%100<20?2:3;case"lv":return count===0?0:count%10==1&&count%100!=11?1:2;case"pl":return count==1?0:count%10>=2&&count%10<=4&&(count%100<12||count%100>14)?1:2;case"cy":return count==1?0:count==2?1:count==8||count==11?2:3;case"ro":return count==1?0:count===0||count%100>0&&count%100<20?1:2;case"ar":return count===0?0:count==1?1:count==2?2:count%100>=3&&count%100<=10?3:count%100>=11&&count%100<=99?4:5;default:return 0}};return Lang});

(function () {
    Lang = new Lang();
    Lang.setMessages({"ca.contents":{"draft":"Esborrany","published":"publicat"},"ca.fields":{"author":"Autor","boolean":"Boole\u00e0","company":"Empresa","contentlist":"Llista","contents":"Continguts","date":"Data","description":"Descripci\u00f3","file":"Arxiu","image":"Imatge","images":"Imatges","key_values":"Clau\/Valor","link":"Enlla\u00e7","localization":"Localitzaci\u00f3","message":"Missatge","richtext":"Richtext","slug":"Slug","subtitle":"Subt\u00edtol","text":"Text","title":"Title","translated_file":"Arxiu traduit","url":"URL","video":"Video"},"ca.widgets":{"AGENCIES":"Agencias de Viajes","BANNER":"Banner","BANNER_CAROUSEL":"Rotatori Banners","BANNER_SLIDE":"Slide Banner","BUTTON":"Bot\u00f3","COLLAPSE_TABS":"FAQ","COMPANIES":"Recursos y Sostenibilidad","CONTACT_FORM":"Formulari contacte","CONTACT_FORM_PRESS":"Formulari Prensa","HEADER":"Cap\u00e7alera","HIGHLIGHTS":"Llista highlights","IMAGE_TEXT_FILE":"Imatge Text Arxiu","IMAGE_TEXT_LINK":"Imatge Text Enlla\u00e7","IMAGE_TEXT_LIST":"Llista Imatge Text","LOGO":"Logo","LOGO_LIST":"Llista Logos","MEMBERS":"Llista de Membres","MEMBERS_BY_PROGRAM":"Membres per Programa","SEPARATOR":"Separador","SUBSCRIBE":"Subscriu-te","TESTIMONIAL":"Testimoni","TESTIMONIAL_LIST":"Llista testimonis","THUMB_CAROUSEL":"Rotatori Thumbnails","THUMB_SLIDE":"Slide Thumb","TITLE_TEXT":"T\u00edtol Text","TWITTER_FEED":"Twitter","TYPOLOGY_BY_CATEGORY":"Llista per categories","TYPOLOGY_CAROUSEL":"Rotatori tipologia","TYPOLOGY_LAST":"Ultims elements","TYPOLOGY_PAGINATED":"Llista paginada","TYPOLOGY_SEARCH_DATE":"Llista amb cerca i data","TYPOLOGY_SELECTION_FILTERS":"Llista amb selecci\u00f3","VIDEO":"Video","WIDGET_1":"Widget 1","WIDGET_2":"Widget 2","WIDGET_3":"Widget 3"},"en.contents":{"draft":"Esborrany","published":"Publicat"},"en.fields":{"author":"Autor","boolean":"Boole\u00e0","company":"Empresa","contentlist":"Llista","contents":"Continguts","date":"Data","description":"Descripci\u00f3","file":"Arxiu","image":"Imatge","images":"Imatges","key_values":"Clau\/Valor","link":"Enlla\u00e7","localization":"Localitzaci\u00f3","message":"Missatge","richtext":"Richtext","slug":"Slug","subtitle":"Subt\u00edtol","text":"Text","title":"Title","translated_file":"Arxiu traduit","url":"URL","video":"Video"},"en.rules":{"emptyTypologyFields":"One or more fields of the typology do not have a correct name\/identifier","maxCharacters":"Max reached","minCharacters":"Max reached","required":"Field is empty !","unique":"Already exist !"},"en.widgets":{"AGENCIES":"Agencias de Viajes","BANNER":"Banner","BANNER_CAROUSEL":"Rotatori Banners","BANNER_SLIDE":"Slide Banner","BLOG":"Blog","BUTTON":"Bot\u00f3","COLLAPSE_TABS":"FAQ","COMPANIES":"Recursos y Sostenibilidad","CONTACT_FORM":"Formulari contacte","CONTACT_FORM_PRESS":"Formulario Prensa","HEADER":"Cap\u00e7alera","HIGHLIGHTS":"Llista highlights","IMAGE_TEXT_FILE":"Imatge Text Arxiu","IMAGE_TEXT_LINK":"Imatge Text Enlla\u00e7","IMAGE_TEXT_LIST":"Llista Imatge Text","LOGO":"Logo","LOGO_LIST":"Llista Logos","MEMBERS":"Llista de Membres","MEMBERS_BY_PROGRAM":"Membres per Programa","SEPARATOR":"Separador","SUBSCRIBE":"Subscriu-te","TESTIMONIAL":"Testimoni","TESTIMONIAL_LIST":"Llista testimonis","THUMB_CAROUSEL":"Rotatori Thumbnails","THUMB_SLIDE":"Slide Thumb","TITLE_TEXT":"T\u00edtol Text","TWITTER_FEED":"Twitter","TYPOLOGY_BY_CATEGORY":"Llista per categories","TYPOLOGY_CAROUSEL":"Rotatori tipologia","TYPOLOGY_LAST":"Ultims elements","TYPOLOGY_PAGINATED":"Llista paginada","TYPOLOGY_SEARCH_DATE":"Llista amb cerca i data","TYPOLOGY_SELECTION_FILTERS":"Llista amb selecci\u00f3","VIDEO":"Video","WIDGET_1":"Widget 1","WIDGET_2":"Widget 2","WIDGET_3":"Widget 3"},"es.contents":{"draft":"Esborrany","published":"Publicado"},"es.fields":{"author":"Autor","boolean":"Boole\u00e0","company":"Empresa","contentlist":"Llista","contents":"Continguts","date":"Data","description":"Descripci\u00f3","file":"Arxiu","image":"Imatge","images":"Imatges","key_values":"Clau\/Valor","link":"Enlla\u00e7","localization":"Localitzaci\u00f3","message":"Missatge","richtext":"Richtext","slug":"Slug","subtitle":"Subt\u00edtol","text":"Text","title":"Title","translated_file":"Arxiu traduit","url":"URL","video":"Video"},"es.widgets":{"AGENCIES":"Agencias de Viajes","BANNER":"Banner","BANNER_CAROUSEL":"Rotatori Banners","BANNER_SLIDE":"Slide Banner","BUTTON":"Bot\u00f3","COLLAPSE_TABS":"FAQ","COMPANIES":"Recursos y Sostenibilidad","CONTACT_FORM":"Formulari contacte","CONTACT_FORM_PRESS":"Formulario Prensa","HEADER":"Cap\u00e7alera","HIGHLIGHTS":"Llista highlights","IMAGE_TEXT_FILE":"Imatge Text Arxiu","IMAGE_TEXT_LINK":"Imatge Text Enlla\u00e7","IMAGE_TEXT_LIST":"Llista Imatge Text","LOGO":"Logo","LOGO_LIST":"Llista Logos","MEMBERS":"Llista de Membres","MEMBERS_BY_PROGRAM":"Membres per Programa","SEPARATOR":"Separador","SUBSCRIBE":"Subscriu-te","TESTIMONIAL":"Testimoni","TESTIMONIAL_LIST":"Llista testimonis","THUMB_CAROUSEL":"Rotatori Thumbnails","THUMB_SLIDE":"Slide Thumb","TITLE_TEXT":"T\u00edtol Text","TWITTER_FEED":"Twitter","TYPOLOGY_BY_CATEGORY":"Llista per categories","TYPOLOGY_CAROUSEL":"Rotatori tipologia","TYPOLOGY_LAST":"Ultims elements","TYPOLOGY_PAGINATED":"Llista paginada","TYPOLOGY_SEARCH_DATE":"Llista amb cerca i data","TYPOLOGY_SELECTION_FILTERS":"Llista amb selecci\u00f3","VIDEO":"Video","WIDGET_1":"Widget 1","WIDGET_2":"Widget 2","WIDGET_3":"Widget 3"},"fr.contents":{"draft":"Brouillon","published":"Publi\u00e9"}});
})();
