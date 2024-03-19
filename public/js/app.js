const pageToast = document.querySelector(".page-toast"); // 하단 토스트창
const nav = document.querySelector("#nav"); // 헤더
const menus = document.querySelectorAll("ul.menu > li"); // 헤더 메뉴
const noticeArea = document.querySelector("#noticeArea"); // 메인 중간 공지글
const mainNoticeNavigation = document.querySelectorAll("#mainNoticeNavigation li"); // 메인 중간 공지글 도트 네비게이션
const mainBoardview = document.querySelector("#mainBoardview"); // 메인 중간 게시판 글
const mainBoardNavigation = document.querySelectorAll("#mainBoardNavigation li"); // 메인 중간 게시판 글 도트 네비게이션
const hamburgerOpen = document.getElementById("hamburgerOpen");  // 햄버거버튼
const hamburgerMenus = document.querySelector(".hamburger-open"); // 햄버거메뉴창
const hamburgerClose = document.querySelector(".hamburger-close"); // 햄버거메뉴 닫기버튼


if (document.location.protocol == 'http:') {
    document.location.href = document.location.href.replace('http:', 'https:');
}



const _url = document.location.href.split("//"); // 전체 url에서 //로 짜름
const __domain__ = filterEmpty(_url[1].split("/")); // url을 잘라서 현재 도메인만 가져옴
let mainCheck = __domain__.length == 1; // 메인인지 체크

let navHideMenu = false; // true면 상단 네비게이션이 안보이는 메뉴

if (!mainCheck) {

    let subHeaderCustom = __domain__[1].split("?")[0];
    // let subHeaderCustomMatch = /donate/gi;
    //
    // // 메인처럼 헤더 배경이 투명이면 아래 포함시킨다
    // if (subHeaderCustom.match(subHeaderCustomMatch)) {
    //     mainCheck = true;
    // }


    // partners 페이지에선 상단 메뉴 가려야 함
    let otherLayouts = /partners/gi;

    if (subHeaderCustom.match(otherLayouts)) {
        navHideMenu = true;
    }
}


/* 메인, 헤더, 푸터 */
// 현재 페이지가 메인이 아니라면 상단 로고를 검은색 로고로 바꿔준다.
if (mainCheck)
{
    navOff();
}
else
{
    navOn();
}

function navOn() {

    if (navHideMenu) {
        return;
    }

    const screenWidth = screen.availWidth;

    if (screenWidth <= 1200) {
        document.querySelector("nav#nav .nav-in .logo-wrap .logo-black.large").style.display = "none";
        document.querySelector("nav#nav .nav-in .logo-wrap .logo-black.medium").style.display = "block";
        document.querySelector("nav#nav .nav-in .logo-wrap .logo-white.large").style.display = "none";
        document.querySelector("nav#nav .nav-in .logo-wrap .logo-white.medium").style.display = "none";

    } else {
        document.querySelector("nav#nav").style.boxShadow = "0px 3px 6px #00000029";
        document.querySelector("nav#nav .nav-in .logo-wrap .logo-black.large").style.display = "block";
        document.querySelector("nav#nav .nav-in .logo-wrap .logo-black.medium").style.display = "none";
        document.querySelector("nav#nav .nav-in .logo-wrap .logo-white.large").style.display = "none";
        document.querySelector("nav#nav .nav-in .logo-wrap .logo-white.medium").style.display = "none";
    }

    document.querySelectorAll(".nav-mobile-menu ul li a").forEach(function(i, v) {
        i.style.color = "#555555";
    })

    document.querySelectorAll(".hamburger-menu div").forEach(function (i) {
        i.style.background = "#555555";
    })

    nav.style.background = "white";
    const $centerMenus = document.querySelectorAll("nav#nav .nav-in .center-menus ul li a")
    $centerMenus.forEach(function(i, v) {
        i.style.color = "#555555";
    });

    document.querySelector("nav#nav .nav-in").style.color = "#555555";
    document.querySelector("nav#nav .nav-in .logo-wrap span").style.color = "#555555";
    document.querySelector("nav#nav .nav-in .right-menus").classList.add("on");
}

function navOff() {

    if (navHideMenu) {
        return;
    }

    if (!mainCheck) return;

    const screenWidth = screen.availWidth;
    const _scroll = document.documentElement.scrollTop;

    if (screenWidth <= 1200) {
        document.querySelector("nav#nav .nav-in .logo-wrap .logo-black.large").style.display = "none";
        document.querySelector("nav#nav .nav-in .logo-wrap .logo-black.medium").style.display = "none";
        document.querySelector("nav#nav .nav-in .logo-wrap .logo-white.large").style.display = "none";
        document.querySelector("nav#nav .nav-in .logo-wrap .logo-white.medium").style.display = "block";

    } else {
        document.querySelector("nav#nav").style.boxShadow = "";
        document.querySelector("nav#nav .nav-in .logo-wrap .logo-black.large").style.display = "none";
        document.querySelector("nav#nav .nav-in .logo-wrap .logo-black.medium").style.display = "none";
        document.querySelector("nav#nav .nav-in .logo-wrap .logo-white.large").style.display = "block";
        document.querySelector("nav#nav .nav-in .logo-wrap .logo-white.medium").style.display = "none";
    }

    document.querySelectorAll(".nav-mobile-menu ul li a").forEach(function(i, v) {
        i.style.color = "white";
    });

    document.querySelectorAll(".hamburger-menu div").forEach(function (i) {
        i.style.background = "white";
    })

    if (_scroll < 1) {
        const subMenusWrap = document.querySelectorAll(".sub-menus-wrap");
        subMenusWrap.forEach(function (i, v) {
            i.style.display = "none";
        })
    }




    nav.style.background = "transparent";
    const $centerMenus = document.querySelectorAll("nav#nav .nav-in .center-menus ul li a")
    $centerMenus.forEach(function(i, v) {
        i.style.color = "white";
    });
    document.querySelector("nav#nav .nav-in .right-menus").style.color = "white"
    document.querySelector("nav#nav .nav-in").style.color = mainCheck ? "white" : "black";
    document.querySelector("nav#nav .nav-in .logo-wrap span").style.color = "white";

    if (mainCheck) {
        document.querySelector("nav#nav .nav-in .right-menus").classList.remove("on");
    }
}

function toastUp() {
    if (pageToast.style.display != "none") {
        pageToast.style.top = "calc( 100% - 100px )";
    }
}

function toastDown() {
    if (pageToast.style.display != "none") {
        pageToast.style.top = "99%";
    }
}




// 메인 드롭다운메뉴 활성화, 비활성화
Array.prototype.forEach.call(menus, function (i, v) {

    i.addEventListener("mouseover", function() {
        navOn();
        var submenus = i.querySelector("div.sub-menus-wrap");
        submenus.style.display = "block";
        var a = i.querySelector("a");
        a.classList.add("on");
        // a.style.width = (i.offsetWidth - 60) + "px";

    });

    i.addEventListener("mouseleave", function() {
        var _scroll = document.documentElement.scrollTop;
        _scroll > 80 ? navOn() : navOff();
        var submenus = i.querySelector("div.sub-menus-wrap");
        var a = i.querySelector("a");
        a.classList.remove("on");
        submenus.style.display = "none";
    })

});

if (!navHideMenu) {

    // 메인 하단의 토스트 닫기
    document.querySelector(".toast-close").onclick = function () {
        pageToast.style.top = "100%";
        setTimeout(function () {
            pageToast.style.display = "none";
        }, 500);
    };

    hamburgerOpen.onclick = function () {
        hamburgerMenus.style.display = "block";
    };

    hamburgerClose.onclick = function () {
        event.preventDefault();
        hamburgerMenus.style.display = "none";
    };


    // 스크롤 내릴때 헤더 bg 변경 및 토스트 활성화/비활성화
    document.addEventListener("scroll", function() {
        const _scroll = document.documentElement.scrollTop;
        if (_scroll > 1) {
            navOn();
            toastUp();
        } else {
            navOff();
            toastDown();
        }
    });

}



// 메인 공지 도트네비게이션 눌렀을때
Array.prototype.forEach.call(mainNoticeNavigation, function (i, v) {

    const screenWidth = screen.availWidth;

    i.addEventListener("click", function() {

        // 1200보다 클때는 4개 모두 나오니 네비게이션 없음.

        // 1200~769 까지는 도트네비가 2개. 2개씩 오픈됨
        if (screenWidth > 768)
        {
            if (v == 0) {
                noticeArea.querySelector("li:nth-child(1)").style.display = "block";
                noticeArea.querySelector("li:nth-child(2)").style.display = "block";
                noticeArea.querySelector("li:nth-child(3)").style.display = "none";
                noticeArea.querySelector("li:nth-child(4)").style.display = "none";
            } else if (v == 1) {
                noticeArea.querySelector("li:nth-child(1)").style.display = "none";
                noticeArea.querySelector("li:nth-child(2)").style.display = "none";
                noticeArea.querySelector("li:nth-child(3)").style.display = "block";
                noticeArea.querySelector("li:nth-child(4)").style.display = "block";
            }
        }

        // 768 이하 일때는 공지가 1개씩 노출되고 도트네비는 3개
        else if (screenWidth <= 768)
        {
            if (v == 0) {
                noticeArea.querySelector("li:nth-child(1)").style.display = "block";
                noticeArea.querySelector("li:nth-child(2)").style.display = "none";
                noticeArea.querySelector("li:nth-child(3)").style.display = "none";
                noticeArea.querySelector("li:nth-child(4)").style.display = "none";
            } else if (v == 1) {
                noticeArea.querySelector("li:nth-child(1)").style.display = "none";
                noticeArea.querySelector("li:nth-child(2)").style.display = "block";
                noticeArea.querySelector("li:nth-child(3)").style.display = "none";
                noticeArea.querySelector("li:nth-child(4)").style.display = "none";
            } else if (v == 2) {
                noticeArea.querySelector("li:nth-child(1)").style.display = "none";
                noticeArea.querySelector("li:nth-child(2)").style.display = "none";
                noticeArea.querySelector("li:nth-child(3)").style.display = "block";
                noticeArea.querySelector("li:nth-child(4)").style.display = "none";
            } else if (v == 3) {
                noticeArea.querySelector("li:nth-child(1)").style.display = "none";
                noticeArea.querySelector("li:nth-child(2)").style.display = "none";
                noticeArea.querySelector("li:nth-child(3)").style.display = "none";
                noticeArea.querySelector("li:nth-child(4)").style.display = "block";
            }
        }

        document.querySelector("#mainNoticeNavigation li.on").classList.remove("on");
        i.classList.add("on");
    })
});
/* 메인, 헤더, 푸터 end */


function sample6_execDaumPostcode(_this) {

    _this.blur();

    new daum.Postcode({
        oncomplete: function(data) {
            // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

            // 각 주소의 노출 규칙에 따라 주소를 조합한다.
            // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
            var addr = ''; // 주소 변수
            var extraAddr = ''; // 참고항목 변수

            //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
            if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                addr = data.roadAddress;
            } else { // 사용자가 지번 주소를 선택했을 경우(J)
                addr = data.jibunAddress;
            }

            // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
            if(data.userSelectedType === 'R'){
                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if(data.buildingName !== '' && data.apartment === 'Y'){
                    extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraAddr !== ''){
                    extraAddr = ' (' + extraAddr + ')';
                }
                // 조합된 참고항목을 해당 필드에 넣는다.
                // document.getElementById("sample6_extraAddress").value = extraAddr;

            } else {
                // document.getElementById("sample6_extraAddress").value = '';
            }

            // 우편번호와 주소 정보를 해당 필드에 넣는다.
            let zipcode = document.getElementById('zipcode');
            let address1 = document.getElementById('address1');
            zipcode.value = data.zonecode;
            address1.value = addr;
            zipcode.parentNode.querySelector("span").classList.add("isValue");
            zipcode.parentNode.querySelector("span").style.marginTop = 0;
            zipcode.parentNode.querySelector("span").style.fontSize = "13px";
            zipcode.style.top = "27px";

            address1.parentNode.querySelector("span").classList.add("isValue");
            address1.parentNode.querySelector("span").style.marginTop = 0;
            address1.parentNode.querySelector("span").style.fontSize = "13px";
            address1.style.top = "27px";
            // 커서를 상세주소 필드로 이동한다.
            document.getElementById("address2").focus();

        }
    }).open();
}


/* 전역사용 */

// 배열에 빈값은 제외하기
function filterEmpty(arr) {
    return arr.filter(function(obj) {
        return obj !== null && obj !== undefined && obj !== "" && obj !== "#" && obj !== "?";
    })
}

// css fadein 효과주기
function fadeIn(selector) {
    if (selector.classList.contains('hidden')) {
        selector.classList.remove("hidden");
    }

    if (selector.classList.contains('fadeout-010')) {
        selector.classList.remove("fadeout-010");
    }
    selector.classList.add("fadein-010");

}

// css fadeout 효과주기
function fadeOut(selector) {
    if (selector.classList.contains('fadein-010')) {
        selector.classList.remove("fadein-010");
    }
    selector.classList.add("fadeout-010");
    selector.classList.add("hidden");
}



// DOM 디스플레이 설정하기
// ex) {block: "p.test span", "li.list a", inlineBlock: "li > p", none: "table.test", flex: "ul.hello" }
function handleDisplayChange(object)
{

    for(let key in object) {

        const displayType = object[key];

        displayType.forEach(function (i) {
            const target = document.querySelectorAll(i);
            target.forEach(function (v) {
                if (key == "inlineBlock") key = "inline-block";
                v.style.display = key;
            })
        })

    }

}



/* SLIDE UP */
let slideUp = function (target, duration) {

    target.webkitAnimationPlayState = 'paused';
    target.style.transitionProperty = 'height, margin, padding';
    target.style.transitionDuration = duration + 'ms';
    target.style.boxSizing = 'border-box';
    target.style.height = target.offsetHeight + 'px';
    target.offsetHeight;
    target.style.overflow = 'hidden';
    target.style.height = 0;
    target.style.paddingTop = 0;
    target.style.paddingBottom = 0;
    target.style.marginTop = 0;
    target.style.marginBottom = 0;
    window.setTimeout( function () {
        target.style.display = 'none';
        target.style.removeProperty('height');
        target.style.removeProperty('padding-top');
        target.style.removeProperty('padding-bottom');
        target.style.removeProperty('margin-top');
        target.style.removeProperty('margin-bottom');
        target.style.removeProperty('overflow');
        target.style.removeProperty('transition-duration');
        target.style.removeProperty('transition-property');
        //alert("!");
    }, duration);
}


/* SLIDE DOWN */
let slideDown = function (target, duration) {

    target.webkitAnimationPlayState = 'paused';
    target.style.removeProperty('display');
    let display = window.getComputedStyle(target).display;
    if (display === 'none') display = 'block';
    target.style.display = display;
    let height = target.offsetHeight;
    target.style.overflow = 'hidden';
    target.style.height = 0;
    target.style.paddingTop = 0;
    target.style.paddingBottom = 0;
    target.style.marginTop = 0;
    target.style.marginBottom = 0;
    target.offsetHeight;
    target.style.boxSizing = 'border-box';
    target.style.transitionProperty = "height, margin, padding";
    target.style.transitionDuration = duration + 'ms';
    target.style.height = height + 'px';
    target.style.removeProperty('padding-top');
    target.style.removeProperty('padding-bottom');
    target.style.removeProperty('margin-top');
    target.style.removeProperty('margin-bottom');
    window.setTimeout( function() {
        target.style.removeProperty('height');
        target.style.removeProperty('overflow');
        target.style.removeProperty('transition-duration');
        target.style.removeProperty('transition-property');
    }, duration);
}

/* TOOGLE */
var slideToggle = function (target, duration) {

    target.webkitAnimationPlayState = 'paused';

    if (window.getComputedStyle(target).display === 'none') {
        return slideDown(target, duration);
    } else {
        return slideUp(target, duration);
    }
}


// 인풋 floating label 효과. span 사용했음
const inputWrap = document.querySelectorAll(".swp-input-wrap input");

inputWrap.forEach(function (i) {

    const $input = i.querySelector("input");
    const $span = i.parentNode.querySelector("span");

    i.addEventListener("focus", function () {
        // $input.focus();
        i.style.top = "27px";

        $span.style.transition = "0.1s ease-in";
        $span.style.marginTop = "0px";
        $span.style.fontSize = "13px";
    })

    i.addEventListener("focusout", function () {

        i.value = i.value.trim();

        if (i.value === "") {

            i.style.top = "16px";

            $span.style.transition = "0.1s ease-in-out";
            $span.style.marginTop = "10px";
            $span.style.fontSize = "16px";

        }

    })

});


/* 아래로 열리는 효과주기  div.spread-animation */
const _spread = document.querySelectorAll(".spread-animation");

_spread.forEach ( function (i) {

    i.onclick = function() {
        slideToggle(i.querySelector(".description"), 400);
    }

})



/* select 선택된것에만 컬러주기 */
const $select_not_null_gray = document.querySelectorAll(".selected-gray--not-null");

$select_not_null_gray.forEach(function (i) {

    i.onchange = function () {
        const _value = i.value.trim();
        if (_value != "") {
            i.style.color = "#555555";
        } else {
            i.style.color = "#969696";
        }
    }

})

// 스무스스크롤링, _target:dom, offset:int
function smoothScrolling(_target) {

    const headerOffset = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : -100;

    const elementPosition = _target.offsetTop;
    const offsetPosition = elementPosition - headerOffset;

    window.scrollTo({
        top: offsetPosition,
        behavior: "smooth"
    });
}


function extractOnlyNumbers(num)
{
    return Number(num.replace(/[^0-9]/g, ""));
}


function getQueryStringObject() {
    var a = window.location.search.substr(1).split('&');
    if (a == "") return {};
    var b = {};
    for (var i = 0; i < a.length; ++i) {
        var p = a[i].split('=', 2);
        if (p.length == 1)
            b[p[0]] = "";
        else
            b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
    }
    return b;
}
