(this.webpackJsonpantdesign=this.webpackJsonpantdesign||[]).push([[0],{154:function(e,a){},158:function(e,a){},159:function(e,a){},160:function(e,a){},161:function(e,a){},165:function(e,a,t){e.exports=t(310)},170:function(e,a,t){},171:function(e,a,t){},275:function(e,a){},310:function(e,a,t){"use strict";t.r(a);var n=t(0),o=t.n(n),l=t(4),c=t.n(l),r=t(38),i=(t(170),t(311)),s=t(92),m=t(314),u=t(313),g=t(312),p=t(30),E=(t(171),t(315)),d=t(316),f=t(317),h=t(318),b=t(319),k=t(320),y=t(321),v=t(322),I=t(323),N=t(324),S=i.a.Header,w=i.a.Footer,x=i.a.Sider,O=i.a.Content,T=(g.a.Title,s.a.SubMenu);function A(e){var a=Object(n.useState)(!1),t=Object(r.a)(a,2),l=t[0],c=t[1];return o.a.createElement("div",{className:"App"},o.a.createElement(i.a,null,o.a.createElement(x,{className:"menuSider",collapsible:!0,collapsed:l},o.a.createElement(s.a,{defaultSelectedKeys:["1"],defaultOpenKeys:["sub1"],mode:"inline",theme:"dark",inlineCollapsed:l},o.a.createElement(s.a.Item,{className:"menuHeader"},o.a.createElement(p.b,{to:"/login"},o.a.createElement(m.a,{className:"menuHeaderPic",src:"/img/ecoandgreen.jpg"}),"Eco&Green")),o.a.createElement(s.a.Item,{key:"dashboard",icon:o.a.createElement(E.a,null)},o.a.createElement(p.b,{to:"/dashboard"}," Dashboard ")),o.a.createElement(s.a.Item,{icon:o.a.createElement(d.a,null),key:"event"},o.a.createElement(p.b,{to:"/event"}," Event")),o.a.createElement(s.a.Item,{key:"pushNotification",icon:o.a.createElement(f.a,null)},o.a.createElement(p.b,{to:"/pushNotification"}," Push Notification")),o.a.createElement(T,{key:"uploads",icon:o.a.createElement(h.a,null),title:"Uploads"},o.a.createElement(s.a.Item,{className:"subLink",key:"aboutUs",icon:o.a.createElement(b.a,null)},o.a.createElement(p.b,{to:"/aboutUs"}," About Us")),o.a.createElement(s.a.Item,{className:"subLink",key:"banner",icon:o.a.createElement(k.a,null)},o.a.createElement(p.b,{to:"/banner"}," Banner")),o.a.createElement(s.a.Item,{className:"subLink",key:"brandImage",icon:o.a.createElement(k.a,null)},o.a.createElement(p.b,{to:"/brand"}," Brand Images")),o.a.createElement(s.a.Item,{className:"subLink",key:"giftImage",icon:o.a.createElement(y.a,null)},o.a.createElement(p.b,{to:"/gift"}," Gift Images")),o.a.createElement(s.a.Item,{className:"subLink",key:"promotionBanner",icon:o.a.createElement(k.a,null)},o.a.createElement(p.b,{to:"/promotion"}," Promotion Banner"))),o.a.createElement(s.a.Item,{className:"subLink",key:"testing"},o.a.createElement(p.b,{to:"/test"},"Testing Page")),o.a.createElement(s.a.Item,{key:"11",icon:o.a.createElement(v.a,null)},o.a.createElement(p.b,{to:"/redemption"}," Redemption Manager")))),o.a.createElement(i.a,{className:"site-layout"},o.a.createElement(S,{style:{background:"orange",paddingLeft:"5px"}},o.a.createElement(l?I.a:N.a,{className:"trigger siderButton",onClick:function(){c(!l),console.log("Now state: "+l)}}),o.a.createElement("span",{className:"profileUserName"},o.a.createElement("b",null,e.userName)),o.a.createElement(m.a,{className:"profilePic",size:"large",icon:"user"})),o.a.createElement(i.a,{style:{padding:"0 24px 24px"}},o.a.createElement(u.a,{style:{margin:"16px 0"}},o.a.createElement(u.a.Item,null,e.pageName),o.a.createElement(u.a.Item,{className:"navigationState"},"Home")),o.a.createElement(O,{id:e.id,className:"site-layout-background",style:{padding:24,margin:0}},e.children)),o.a.createElement(w,{className:"footer"},"Eco & Green Exhibition \xa92020 All Rights Reserved."))))}var C=t(16),j=t(154),P=t.n(j),_=t(155),B=t.n(_),L=t(156),M=t.n(L),R=t(157),U=t.n(R);function K(){o.a.createRef();return o.a.createElement(A,null,o.a.createElement(B.a,{editor:M.a,data:"",onChange:function(e,a){a.getData()}}),o.a.createElement("div",null,o.a.createElement("p",null,U()(""))))}var G=t(158),H=t.n(G);function z(){return o.a.createElement(A,null,o.a.createElement("h2",null," It can be anything but please show me Dashboard"))}t(293);var D=t(29),V=t.n(D);t(128);function J(){return V()(document).ready((function(){console.log("Event Page, Token = "+localStorage.getItem("_token"))})),o.a.createElement("div",{id:"testing"},o.a.createElement("button",{style:{padding:"15px"},onClick:function(){console.log("getME now !"),V.a.ajax({url:"https://staging.ecogreenapp.com/public/api/auth/me",method:"POST",headers:{"Access-Control-Allow-Origin":"*",Authorization:"Bearer ".concat(localStorage.getItem("_token"))},beforeSend:function(e,a){},success:function(e){console.log("Where AM I now? "+e),V()("#testing").append(e),e?V.a.each(e,(function(e,a){console.log("Key = "+e+" Value = "+a)})):window.location.href="http://react.ecogreenapp.com/login"}})}},"ME"),o.a.createElement("button",{style:{padding:"15px"},onClick:function(){console.log("getUserNow!"),V.a.ajax({url:"https://staging.ecogreenapp.com/public/api/auth/refresh",method:"POST",header:"Access-Control-Allow-Origin: *",data:{},beforeSend:function(){console.log("Before refresh"),console.log("Token = "+localStorage.getItem("_token"))},success:function(e){},complete:function(){console.log("Token now = "+localStorage.getItem("_token"))}})}},"Refresh Token"),o.a.createElement("button",{style:{padding:"15px"},onClick:function(){return V.a.ajax({url:"https://staging.ecogreenapp.com/public/api/auth/return",method:"GET",data:{},headers:{"Access-Control-Allow-Origin":"*","Content-Type":"application/json",Authorization:"Bearer ".concat(localStorage.getItem("_token"))},beforeSend:function(e){},success:function(e){V()("#testing").append("Authorization "+localStorage.getItem("_token")),V.a.each(e,(function(e,a){V()("#anything").append("Key = "+e+" Value = "+a)}))}}),!1}},"Message"),o.a.createElement("div",{id:"anything"}))}var F=t(159),W=t.n(F);function q(){var e=o.a.createRef(),a=o.a.createRef();return o.a.createElement(A,{user:""},"Email: ",o.a.createElement("input",{type:"text",name:"email",onChange:function(e){console.log("Email="+e.target.value);var a=Object(r.a)(e.target.value,1)[0];console.log(a)},ref:e}),"Password:",o.a.createElement("input",{type:"password",name:"password",onChage:function(e){console.log("Password = "+e.target.value);var a=Object(r.a)(e.target.value,1)[0];console.log(a)},ref:a}),o.a.createElement("button",{onClick:function(t){console.log("logging in!"),V.a.ajax({url:"https://staging.ecogreenapp.com/public/api/auth/login",type:"POST",header:{"Access-Control-Allow-Origin":"*"},data:{email:e.current.value,password:a.current.value},beforeSend:function(){console.log("This token = "+localStorage.getItem("_token"))},success:function(e){console.log("Before "),console.log(e),console.log("After"),V.a.each(e,(function(e,a){console.log("Key = "+e+" Value = "+a),"access_token"==e&&(localStorage.setItem("_token",a),console.log("Inside access_token now = "+a))})),console.log("This is TOKEN = "+localStorage.getItem("_token")),window.location.href="https://react.ecogreenapp.com/event"},error:function(e,a,t){console.log("Error login = "+e.responseText)}})}},"Login"))}var Q=t(160),X=t.n(Q),Y=t(161),Z=t.n(Y),$=t(40),ee=t(53),ae=t(78),te=t(77),ne=function(e){Object(ae.a)(t,e);var a=Object(te.a)(t);function t(){return Object($.a)(this,t),a.apply(this,arguments)}return Object(ee.a)(t,[{key:"render",value:function(){return o.a.createElement(A,null,"HELLO TESTING")}}]),t}(n.Component);var oe=function(){return o.a.createElement(p.a,null,o.a.createElement("div",null,o.a.createElement(C.a,{exact:!0,path:"/",component:A}),o.a.createElement(C.a,{path:"/aboutUs",component:P.a}),o.a.createElement(C.a,{path:"/banner",component:K}),o.a.createElement(C.a,{path:"/brand",component:H.a}),o.a.createElement(C.a,{exact:!0,path:"/dashboard",component:z}),o.a.createElement(C.a,{path:"/event",component:J}),o.a.createElement(C.a,{path:"/gift",component:W.a}),o.a.createElement(C.a,{exact:!0,path:"/login",component:q}),o.a.createElement(C.a,{path:"/promotion",component:X.a}),o.a.createElement(C.a,{path:"/pushNotification",component:Z.a}),o.a.createElement(C.a,{path:"/test",component:ne})))};c.a.render(o.a.createElement(o.a.StrictMode,null,o.a.createElement(oe,null)),document.getElementById("root"))}},[[165,1,2]]]);
//# sourceMappingURL=main.1a0fdec7.chunk.js.map