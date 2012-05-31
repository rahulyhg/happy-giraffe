﻿/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

(function(){CKEDITOR.on('dialogDefinition',function(r){var s,t=r.data.name,u=r.data.definition;if(t=='link'){u.removeContents('target');u.removeContents('upload');u.removeContents('advanced');s=u.getContents('info');s.remove('emailSubject');s.remove('emailBody');}else if(t=='image'){u.removeContents('advanced');s=u.getContents('Link');s.remove('cmbTarget');s=u.getContents('info');s.remove('txtAlt');s.remove('basic');}});var a={b:'strong',u:'u',i:'em',color:'span',size:'span',quote:'blockquote',code:'code',url:'a',email:'span',img:'span','*':'li',list:'ol'},b={strong:'b',b:'b',u:'u',em:'i',i:'i',code:'code',li:'*'},c={strong:'b',em:'i',u:'u',li:'*',ul:'list',ol:'list',code:'code',a:'link',img:'img',blockquote:'quote'},d={color:'color',size:'font-size'},e={url:'href',email:'mailhref',quote:'cite',list:'listType'},f=CKEDITOR.dtd,g=CKEDITOR.tools.extend({table:1},f.$block,f.$listItem,f.$tableContent,f.$list),h=/\s*(?:;\s*|$)/;function i(r){var s='';for(var t in r){var u=r[t],v=(t+':'+u).replace(h,';');s+=v;}return s;};function j(r){var s={};(r||'').replace(/&quot;/g,'"').replace(/\s*([^ :;]+)\s*:\s*([^;]+)\s*(?=;|$)/g,function(t,u,v){s[u.toLowerCase()]=v;});return s;};function k(r){return r.replace(/(?:rgb\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)\s*\))/gi,function(s,t,u,v){t=parseInt(t,10).toString(16);u=parseInt(u,10).toString(16);v=parseInt(v,10).toString(16);var w=[t,u,v];for(var x=0;x<w.length;x++)w[x]=String('0'+w[x]).slice(-2);return '#'+w.join('');});};var l={smiley:':)',sad:':(',wink:';)',laugh:':D',cheeky:':P',blush:':*)',surprise:':-o',indecision:':|',angry:'>:(',angel:'o:)',cool:'8-)',devil:'>:-)',crying:';(',kiss:':-*'},m={},n=[];for(var o in l){m[l[o]]=o;n.push(l[o].replace(/\(|\)|\:|\/|\*|\-|\|/g,function(r){return '\\'+r;}));}n=new RegExp(n.join('|'),'g');var p=(function(){var r=[],s={nbsp:'\xa0',shy:'­',gt:'>',lt:'<'};for(var t in s)r.push(t);r=new RegExp('&('+r.join('|')+');','g');return function(u){return u.replace(r,function(v,w){return s[w];});};})();CKEDITOR.BBCodeParser=function(){this._={bbcPartsRegex:/(?:\[([^\/\]=]*?)(?:=([^\]]*?))?\])|(?:\[\/([a-z]{1,16})\])/ig};};CKEDITOR.BBCodeParser.prototype={parse:function(r){var B=this;var s,t,u=0;while(s=B._.bbcPartsRegex.exec(r)){var v=s.index;if(v>u){var w=r.substring(u,v);B.onText(w,1);}u=B._.bbcPartsRegex.lastIndex;t=(s[1]||s[3]||'').toLowerCase();if(t&&!a[t]){B.onText(s[0]);continue;}if(s[1]){var x=a[t],y={},z={},A=s[2];if(A){if(t=='list')if(!isNaN(A))A='decimal';else if(/^[a-z]+$/.test(A))A='lower-alpha';
else if(/^[A-Z]+$/.test(A))A='upper-alpha';if(d[t]){if(t=='size')A+='%';z[d[t]]=A;y.style=i(z);}else if(e[t])y[e[t]]=A;}if(t=='email'||t=='img')y.bbcode=t;B.onTagOpen(x,y,CKEDITOR.dtd.$empty[x]);}else if(s[3])B.onTagClose(a[t]);}if(r.length>u)B.onText(r.substring(u,r.length),1);}};CKEDITOR.htmlParser.fragment.fromBBCode=function(r){var s=new CKEDITOR.BBCodeParser(),t=new CKEDITOR.htmlParser.fragment(),u=[],v=0,w=t,x;function y(D){if(u.length>0)for(var E=0;E<u.length;E++){var F=u[E],G=F.name,H=CKEDITOR.dtd[G],I=w.name&&CKEDITOR.dtd[w.name];if((!I||I[G])&&(!D||!H||H[D]||!CKEDITOR.dtd[D])){F=F.clone();F.parent=w;w=F;u.splice(E,1);E--;}}};function z(D,E){var F=w.children.length,G=F>0&&w.children[F-1],H=!G&&q.getRule(c[w.name],'breakAfterOpen'),I=G&&G.type==CKEDITOR.NODE_ELEMENT&&q.getRule(c[G.name],'breakAfterClose'),J=D&&q.getRule(c[D],E?'breakBeforeClose':'breakBeforeOpen');if(v&&(H||I||J))v--;if(v&&D in g)v++;while(v&&v--)w.children.push(G=new CKEDITOR.htmlParser.element('br'));};function A(D,E){z(D.name,1);E=E||w||t;var F=E.children.length,G=F>0&&E.children[F-1]||null;D.previous=G;D.parent=E;E.children.push(D);if(D.returnPoint){w=D.returnPoint;delete D.returnPoint;}};s.onTagOpen=function(D,E,F){var G=new CKEDITOR.htmlParser.element(D,E);if(CKEDITOR.dtd.$removeEmpty[D]){u.push(G);return;}var H=w.name,I=H&&(CKEDITOR.dtd[H]||(w._.isBlockLike?CKEDITOR.dtd.div:CKEDITOR.dtd.span));if(I&&!I[D]){var J=false,K;if(D==H)A(w,w.parent);else if(D in CKEDITOR.dtd.$listItem){s.onTagOpen('ul',{});K=w;J=true;}else{A(w,w.parent);u.unshift(w);J=true;}if(K)w=K;else w=w.returnPoint||w.parent;if(J){s.onTagOpen.apply(this,arguments);return;}}y(D);z(D);G.parent=w;G.returnPoint=x;x=0;if(G.isEmpty)A(G);else w=G;};s.onTagClose=function(D){for(var E=u.length-1;E>=0;E--){if(D==u[E].name){u.splice(E,1);return;}}var F=[],G=[],H=w;while(H.type&&H.name!=D){if(!H._.isBlockLike)G.unshift(H);F.push(H);H=H.parent;}if(H.type){for(E=0;E<F.length;E++){var I=F[E];A(I,I.parent);}w=H;A(H,H.parent);if(H==w)w=w.parent;u=u.concat(G);}};s.onText=function(D){var E=CKEDITOR.dtd[w.name];if(!E||E['#']){z();y();D.replace(/([\r\n])|[^\r\n]*/g,function(F,G){if(G!==undefined&&G.length)v++;else if(F.length){var H=0;F.replace(n,function(I,J){A(new CKEDITOR.htmlParser.text(F.substring(H,J)),w);A(new CKEDITOR.htmlParser.element('smiley',{desc:m[I]}),w);H=J+I.length;});if(H!=F.length)A(new CKEDITOR.htmlParser.text(F.substring(H,F.length)),w);}});}};s.parse(CKEDITOR.tools.htmlEncode(r));while(w.type){var B=w.parent,C=w;
A(C,B);w=B;}return t;};CKEDITOR.htmlParser.BBCodeWriter=CKEDITOR.tools.createClass({$:function(){var r=this;r._={output:[],rules:[]};r.setRules('list',{breakBeforeOpen:1,breakAfterOpen:1,breakBeforeClose:1,breakAfterClose:1});r.setRules('*',{breakBeforeOpen:1,breakAfterOpen:0,breakBeforeClose:1,breakAfterClose:0});r.setRules('quote',{breakBeforeOpen:1,breakAfterOpen:0,breakBeforeClose:0,breakAfterClose:1});},proto:{setRules:function(r,s){var t=this._.rules[r];if(t)CKEDITOR.tools.extend(t,s,true);else this._.rules[r]=s;},getRule:function(r,s){return this._.rules[r]&&this._.rules[r][s];},openTag:function(r,s){var u=this;if(r in a){if(u.getRule(r,'breakBeforeOpen'))u.lineBreak(1);u.write('[',r);var t=s.option;t&&u.write('=',t);u.write(']');if(u.getRule(r,'breakAfterOpen'))u.lineBreak(1);}else if(r=='br')u._.output.push('\n');},openTagClose:function(){},attribute:function(){},closeTag:function(r){var s=this;if(r in a){if(s.getRule(r,'breakBeforeClose'))s.lineBreak(1);r!='*'&&s.write('[/',r,']');if(s.getRule(r,'breakAfterClose'))s.lineBreak(1);}},text:function(r){this.write(r);},comment:function(){},lineBreak:function(){var r=this;if(!r._.hasLineBreak&&r._.output.length){r.write('\n');r._.hasLineBreak=1;}},write:function(){this._.hasLineBreak=0;var r=Array.prototype.join.call(arguments,'');this._.output.push(r);},reset:function(){this._.output=[];this._.hasLineBreak=0;},getHtml:function(r){var s=this._.output.join('');if(r)this.reset();return p(s);}}});var q=new CKEDITOR.htmlParser.BBCodeWriter();CKEDITOR.plugins.add('bbcode',{requires:['htmldataprocessor','entities'],beforeInit:function(r){var s=r.config;CKEDITOR.tools.extend(s,{enterMode:CKEDITOR.ENTER_BR,basicEntities:false,entities:false,fillEmptyBlocks:false},true);},init:function(r){var s=r.config;function t(v){var w=CKEDITOR.htmlParser.fragment.fromBBCode(v),x=new CKEDITOR.htmlParser.basicWriter();w.writeHtml(x,u);return x.getHtml(true);};var u=new CKEDITOR.htmlParser.filter();u.addRules({elements:{blockquote:function(v){var w=new CKEDITOR.htmlParser.element('div');w.children=v.children;v.children=[w];var x=v.attributes.cite;if(x){var y=new CKEDITOR.htmlParser.element('cite');y.add(new CKEDITOR.htmlParser.text(x.replace(/^"|"$/g,'')));delete v.attributes.cite;v.children.unshift(y);}},span:function(v){var w;if(w=v.attributes.bbcode){if(w=='img'){v.name='img';v.attributes.src=v.children[0].value;v.children=[];}else if(w=='email'){v.name='a';v.attributes.href='mailto:'+v.children[0].value;}delete v.attributes.bbcode;
}},ol:function(v){if(v.attributes.listType){if(v.attributes.listType!='decimal')v.attributes.style='list-style-type:'+v.attributes.listType;}else v.name='ul';delete v.attributes.listType;},a:function(v){if(!v.attributes.href)v.attributes.href=v.children[0].value;},smiley:function(v){v.name='img';var w=v.attributes.desc,x=s.smiley_images[CKEDITOR.tools.indexOf(s.smiley_descriptions,w)],y=CKEDITOR.tools.htmlEncode(s.smiley_path+x);v.attributes={src:y,'data-cke-saved-src':y,title:w,alt:w};}}});r.dataProcessor.htmlFilter.addRules({elements:{$:function(v){var w=v.attributes,x=j(w.style),y,z=v.name;if(z in b)z=b[z];else if(z=='span'){if(y=x.color){z='color';y=k(y);}else if(y=x['font-size']){var A=y.match(/(\d+)%$/);if(A){y=A[1];z='size';}}}else if(z=='ol'||z=='ul'){if(y=x['list-style-type']){switch(y){case 'lower-alpha':y='a';break;case 'upper-alpha':y='A';break;}}else if(z=='ol')y=1;z='list';}else if(z=='blockquote'){try{var B=v.children[0],C=v.children[1],D=B.name=='cite'&&B.children[0].value;if(D){y='"'+D+'"';v.children=C.children;}}catch(G){}z='quote';}else if(z=='a'){if(y=w.href)if(y.indexOf('mailto:')!==-1){z='email';v.children=[new CKEDITOR.htmlParser.text(y.replace('mailto:',''))];y='';}else{var E=v.children.length==1&&v.children[0];if(E&&E.type==CKEDITOR.NODE_TEXT&&E.value==y)y='';z='url';}}else if(z=='img'){v.isEmpty=0;var F=w['data-cke-saved-src'];if(F&&F.indexOf(r.config.smiley_path)!=-1)return new CKEDITOR.htmlParser.text(l[w.alt]);else v.children=[new CKEDITOR.htmlParser.text(F)];}v.name=z;y&&(v.attributes.option=y);return null;},br:function(v){var w=v.next;if(w&&w.name in g)return false;}}},1);r.dataProcessor.writer=q;r.on('beforeSetMode',function(v){v.removeListener();var w=r._.modes.wysiwyg;w.loadData=CKEDITOR.tools.override(w.loadData,function(x){return function(y){return x.call(this,t(y));};});});},afterInit:function(r){var s;if(r._.elementsPath)if(s=r._.elementsPath.filters)s.push(function(t){var u=t.getName(),v=c[u]||false;if(v=='link'&&t.getAttribute('href').indexOf('mailto:')===0)v='email';else if(u=='span'){if(t.getStyle('font-size'))v='size';else if(t.getStyle('color'))v='color';}else if(v=='img'){var w=t.data('cke-saved-src');if(w&&w.indexOf(r.config.smiley_path)===0)v='smiley';}return v;});}});})();
