function testing()
{
    return axios.post("/donate/popbill/check", {
        bankName: "카카오뱅크",
        bankNumber: "3333117471354"
    })
        .then(function (response) {
            return response.data.resultCode;
        });
}

function callPopbillAccountCheck(bankName, bankNumber)
{
    return axios.post("/donate/popbill/check", {
        bankName: "카카오뱅크",
        bankNumber: "3333117471354"
    })
}


const validate = async(f) => {
    let validator = {
        program_id: {
            msg: "프로그램명이 없습니다.",
            required: true,
        },
        donation_type: {
            msg: "기부유형을 선택해주세요.",
            required: true,
            focus: function () {
                smoothScrolling(document.getElementById("donateTypes"), 300);
            }
        },
        donator_type: {
            msg: "기부자 유형을 선택해주세요.",
            required: true
        },
        payment_type: {
            msg: "납입방법을 선택해주세요.",
            required: true,
            focus: function () {
                smoothScrolling(document.getElementById("paymentTypes"), 300);
            }
        },
        receipt_check: {
            msg: "기부자 영수증 발급용도를 체크해주세요.",
            required: true,
            focus: function () {
                smoothScrolling(document.getElementById("receiptCheck"), 300);
            }
        },
        donation_price: {
            msg: "기부금액을 선택해주세요.",
            required: true,
            except: true,
        },
        divide_count: {
            msg: "분할납부 분할횟수가 없습니다.",
            required: true,
        },
        name: {
            msg: "성명/법인명을 입력해주세요.",
            required: true,
        },
        tel: {
            msg: "전화번호를 입력해주세요.",
            required: true,
        },
        regNumber: {
            msg: "주민번호/사업자등록번호를 입력해주세요.",
            required: true,
        },
        zipcode: {
            msg: "우편번호를 입력해주세요.",
            required: true,
        },
        address1: {
            msg: "주소를 입력해주세요",
            required: true,
        },
        address2: {
            msg: "상세주소를 입력해주세요.",
            required: true,
        },
        relationship: {
            msg: "학교와의 관계를 선택해주세요.",
            required: true,
        },
        enter_year: {
            msg: "입학연도를 선택해주세요.",
            required: true,
        },
        course: {
            msg: "학과/이수과정을 입력해주세요.",
            required: true,
        },
        automatic_transfer_assign_day: {
            msg: "자동이체 지정일을 선택해주세요.",
            required: true,
        },
        automatic_bank_name: {
            msg: "자동이체 은행명을 선택해주세요.",
            required: true,
            except: true,
        },
        automatic_bank_number: {
            msg: "자동이체 계좌번호를 입력해주세요.",
            required: true,
        },
        benefit_check: {
            msg: "기부자 예우혜택 제공 용도를 체크해주세요.",
            required: false,
        },
        tax_check: {
            msg: "세제혜택 편의 제공, 기부금 결제를 체크해주세요.",
            required: false,
        },
        credit_card_number: {
            msg: "신용카드 카드번호를 입력해주세요.",
            required: true,
        },
        credit_card_expiration: {
            msg: "신용카드 유효기간을 입력해주세요.",
            required: true,
        },
    };

    let fail = false;

    for (let key in validator) {

        let error = f[key].value == "";
        let disable = false;
        const parent = f[key].parentNode;
        if (parent.classList.contains("type-required-warning")) parent.classList.remove("type-required-warning");

        if (key == "receipt_check" || key == "benefit_check" || key == "tax_check") {
            error = !f[key].checked;
        }

        if (f[key].disabled) {
            error = false;
            disable = true;
        }

        validator[key].error = error;
        validator[key].disable = disable;


        if (error && validator[key].required) {
            fail = true;
            if (!validator[key].except
                && parent.nodeName != "FORM"
                && f[key].type != "checkbox"
            ) {
                parent.classList.add("type-required-warning");
            }
        }

    }

    if (fail) {
        for (let key in validator) {
            if (validator[key].error) {
                alert(validator[key].msg);
                if (!validator[key].focus) {
                    f[key].focus();
                } else {
                    validator[key].focus()
                }
                return false;
            }
        }
    }

    if (f.payment_type.value == "자동이체") {

        let data = {};
        let result = false;

        await axios.post("/donate/popbill/check", {
            bankName: "카카오뱅크",
            bankNumber: "3333117471354"
        })
            .then(function (response) {
                data = response.data;
                result = true;
            })
            .catch(function (error) {
                console.error("request is failed...");
                data = false;
            })


        if (typeof data.resultCode != "undefined" && data.resultCode == "0000") {
            console.log("true....")
            return true;
        } else {
            alert("예금주조회에 실패했습니다. " + data.resultMessage);
            return false;
        }


    }
    else {
        return true;
    }

    return false;

}


document.querySelectorAll(".swp-input-wrap input, .swp-input-wrap select").forEach(function (i) {
    i.addEventListener("focus", function() {
        i.parentNode.classList.add("type-focus")
    });
    i.addEventListener("blur", function () {
        i.parentNode.classList.remove("type-focus")
    })
})


// 개인정보 수집 이용 동의 전체동의 버튼 누르기
document.getElementById("all_check").onclick = function (e) {
    const _checked = e.target.checked;
    document.getElementById("receipt").checked = _checked;
    document.getElementById("benefit").checked = _checked;
    document.getElementById("tax").checked = _checked;
}

// 물음표 모달 띄우기
document.querySelectorAll(".donate-question").forEach(function (i,v) {

    i.onclick = function () {
        event.preventDefault();
        const modal = this.querySelector(".modal-small");
        modal.style.display = modal.style.display === "block" ? "none" : "block";
    }

});


// 기부타입 변경하기
const donationTypes = document.querySelectorAll(".donate .donate-info__body .donate-types li a");

donationTypes.forEach(function (i,v) {

    i.onclick = function (e) {

        e.preventDefault();

        const use = i.dataset.use == "true" ? true : false;

        if (!use) {
            alert("해당 프로그램에서 사용할 수 없는 기부방식입니다.");
            return;
        }


        const selectedDonationType = document.querySelector(".donate .donate-info__body .donate-types li.on");
        const prt = i.parentNode;

        if (selectedDonationType && selectedDonationType.classList.contains("on")) {
            selectedDonationType.classList.remove("on");
        }

        prt.classList.add("on");

        const type = i.dataset.type;
        const screenWidth = screen.availWidth;
        const donationInput = document.querySelector("input[name='donation_type']");

        donationInput.value = type;

        switch (type)
        {
            case "정기기부":
                handleDisplayChange({
                    block: [
                        ".donate .donate-info__body .donate-price li a p.type-routine"
                    ],
                    flex: [
                        ".donate .donate-info__body .donate-price li[data-price='1']",
                        ".donate .donate-info__body .donate-price li[data-price='3']",
                        ".donate .donate-info__body .donate-price li[data-price='10']"
                    ],
                    none: [
                        ".donate .donate-info__body .donate-price li[data-price='5']",
                        ".donate .donate-info__body .donate-divide-selector"
                    ]
                })
                document.querySelectorAll(".donate-divide-selector input").forEach(function (_input) {
                    _input.disabled = true;
                })

                break;

            case "일시기부":
                handleDisplayChange({
                    flex: [
                        ".donate .donate-info__body .donate-price li[data-price='3']",
                        ".donate .donate-info__body .donate-price li[data-price='5']",
                        ".donate .donate-info__body .donate-price li[data-price='10']"
                    ],
                    none: [
                        ".donate .donate-info__body .donate-price li[data-price='1']",
                        ".donate .donate-info__body .donate-price li a p.type-routine",
                        ".donate .donate-info__body .donate-divide-selector"
                    ]
                })
                document.querySelectorAll(".donate-divide-selector input").forEach(function (_input) {
                    _input.disabled = true;
                })
                break;

            case "분할납부":

                if (screenWidth > 769)
                {
                    handleDisplayChange({
                        flex: [
                            ".donate .donate-info__body .donate-price li[data-price='3']",
                            ".donate .donate-info__body .donate-price li[data-price='5']",
                            ".donate .donate-info__body .donate-price li[data-price='10']",
                            ".donate .donate-info__body .donate-divide-selector"
                        ],
                        none: [
                            ".donate .donate-info__body .donate-price li[data-price='1']",
                            ".donate .donate-info__body .donate-price li a p.type-routine"
                        ]
                    });
                }
                else
                {
                    handleDisplayChange({
                        flex: [
                            ".donate .donate-info__body .donate-price li[data-price='3']",
                            ".donate .donate-info__body .donate-price li[data-price='5']",
                            ".donate .donate-info__body .donate-price li[data-price='10']",
                        ],
                        block: [
                            ".donate .donate-info__body .donate-divide-selector"
                        ],
                        none: [
                            ".donate .donate-info__body .donate-price li[data-price='1']",
                            ".donate .donate-info__body .donate-price li a p.type-routine"
                        ]
                    });
                }

                document.querySelectorAll(".donate-divide-selector input").forEach(function (_input) {
                    _input.disabled = false;
                })
                setDonateDivide();
                break;

        }

    }
})

const $donatePriceInput = document.querySelector("input[name='donation_price']");

// 1만원, 3만원, 5만원 클릭 이벤트
const addDonatePrice = document.querySelectorAll(".donate .donate-info__body .donate-price li a");
const fixing_check = document.getElementById("fixing_check").value;
addDonatePrice.forEach(function(i) {

    i.onclick = function (e) {

        e.preventDefault();

        if (fixing_check == 1) {
            alert("기부금액이 지정된 프로그램입니다.");
            return;
        }

        const price = Number(i.dataset.price) * 10000;
        // let _price = Number(extractOnlyNumbers($donatePriceInput.value));
        $donatePriceInput.value = (price).toLocaleString() + " 원";
        setDonateDivide()

    }
});


// 분할납부 +, - 하기
const dividerCalculate = document.querySelectorAll(".input-calc-button");

dividerCalculate.forEach(function (i) {

    i.onclick = function () {
        const _type = this.dataset.calc;
        const donatePrice = Number(extractOnlyNumbers(document.querySelector("input[name='donation_price']").value));
        let dividerCount = Number(extractOnlyNumbers(document.querySelector("input[name='divide_count']").value));

        if (_type === "+") {
            dividerCount++;
        } else if (_type === "-") {
            if (dividerCount == 1) return false;
            dividerCount--;
        }

        document.querySelector("input[name='divide_count']").value = dividerCount;

        setDonateDivide(donatePrice, document.querySelector("input[name='divide_count']").value);
    }

});


// 분할납부 계산 함수
function setDonateDivide()
{
    let price = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document.querySelector('input[name="donation_price"]').value;
    let count = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 10;

    if (typeof price != "number") {
        price = extractOnlyNumbers(price);
    }

    if (typeof count != "number") {
        count = extractOnlyNumbers(count);
    }

    const divideCount = document.querySelector("input[name='divide_count']");
    const dividePrice = document.querySelector("input[name='divide_price']");
    const divideNotice = document.querySelector("span#divideNotice");
    divideCount.value = count + "회";
    dividePrice.value = Math.round(price / count).toLocaleString() + " 원";
    divideNotice.innerHTML = count + "개월 간 매달";
}


// 기부자 타입 선택
const donatorSelector = document.querySelectorAll(".donate .donator-info__body .donator-type li a");
donatorSelector.forEach (function (i) {
    i.onclick = function (e) {
        e.preventDefault();
        const _focused = document.querySelector(".donate .donator-info__body .donator-type li.on");
        if (_focused) {
            _focused.classList.remove("on");
        }
        i.parentNode.classList.add("on")
        const _type = i.dataset.type;
        const donator_type = document.querySelector("input[name='donator_type']");
        donator_type.value = _type;

        switch (_type)
        {
            case "개인":
                document.querySelector(".anony-hide").style.display = "block";
                document.querySelectorAll(".anony-hide input, .anony-hide select").forEach (function ($input) {
                    if ($input.name != "course" && $input.name != "enter_year") {
                        $input.disabled = false;
                    } else {
                        $input.parentNode.style.display = "none";
                        $input.disabled = true;
                    }
                    if ($input.name == "relationship") {
                        $input.value = "";
                    }
                })
                document.querySelector("span.label-input-name").innerHTML = "성명";
                document.querySelector("span.label-input-rsno").innerHTML = "주민등록번호";
                break;
            case "법인":
                document.querySelector(".anony-hide").style.display = "block";
                document.querySelectorAll(".anony-hide input, .anony-hide select").forEach (function ($input) {
                    if ($input.name != "course" && $input.name != "enter_year") {
                        $input.disabled = false;
                    } else {
                        $input.parentNode.style.display = "none";
                        $input.disabled = true;
                    }
                    if ($input.name == "relationship") {
                        $input.value = "";
                    }
                })
                document.querySelector("span.label-input-name").innerHTML = "법인명";
                document.querySelector("span.label-input-rsno").innerHTML = "사업자등록번호";
                break;
            case "익명":
                document.querySelector(".anony-hide").style.display = "none";
                document.querySelectorAll(".anony-hide input, .anony-hide select").forEach (function ($input) {
                    $input.disabled = true;
                });
                break;
        }

    }
})

// 결제방법 선택자
const creditCardInputWrap = document.querySelector(".creditcard-show");
const automaticInputWrap = document.querySelector(".automatic-show");
const paymentType = document.querySelectorAll(".donate .donate-payment-body ul li a");
paymentType.forEach (function (i) {

    i.onclick = function (e) {
        e.preventDefault();

        const _focused = document.querySelector(".donate .donate-payment-body ul li.on")
        if(_focused) {
            _focused.classList.remove("on");
        }
        i.parentNode.classList.add('on');
        const _type = this.dataset.type;
        const input_payment_type = document.querySelector("input[name='payment_type']");
        input_payment_type.value = _type;

        switch (_type)
        {
            case "자동이체":
                creditCardInputWrap.style.display = "none";
                automaticInputWrap.style.display = "block";
                creditCardInputWrap.querySelectorAll("input").forEach(function($input) {
                    $input.disabled = true;
                });
                automaticInputWrap.querySelectorAll("input, select").forEach(function($input) {
                    $input.disabled = false;
                });
                break;
            case "무통장입금":
                creditCardInputWrap.style.display = "none";
                automaticInputWrap.style.display = "none";
                creditCardInputWrap.querySelectorAll("input").forEach(function($input) {
                    $input.disabled = true;
                });
                automaticInputWrap.querySelectorAll("input, select").forEach(function($input) {
                    $input.disabled = true;
                });
                break;
            case "신용카드":
                creditCardInputWrap.style.display = "block";
                automaticInputWrap.style.display = "none";
                creditCardInputWrap.querySelectorAll("input").forEach(function($input) {
                    $input.disabled = false;
                });
                automaticInputWrap.querySelectorAll("input, select").forEach(function($input) {
                    $input.disabled = true;
                });
                break;
            case "카카오페이":
                creditCardInputWrap.style.display = "none";
                automaticInputWrap.style.display = "none";
                creditCardInputWrap.querySelectorAll("input").forEach(function($input) {
                    $input.disabled = true;
                });
                automaticInputWrap.querySelectorAll("input, select").forEach(function($input) {
                    $input.disabled = true;
                });
                break;
            case "네이버페이":
                creditCardInputWrap.style.display = "none";
                automaticInputWrap.style.display = "none";
                creditCardInputWrap.querySelectorAll("input").forEach(function($input) {
                    $input.disabled = true;
                });
                automaticInputWrap.querySelectorAll("input, select").forEach(function($input) {
                    $input.disabled = true;
                });
                break;
            default: break;
        }
    }

})


// 자동이체 날짜 선택하기
const automatic_transfer_assign = document.querySelectorAll("#automatic_transfer_assign li")
const automatic_transfer_assign_day = document.querySelector("input[name='automatic_transfer_assign_day']")

automatic_transfer_assign.forEach(function (dom) {

    dom.onclick = function (e) {

        e.preventDefault();

        const day = dom.dataset.day;
        if (!day) return false;

        const focus_day = document.querySelector("#automatic_transfer_assign li.on");
        if (focus_day) {
            focus_day.classList.remove("on");
        }


        automatic_transfer_assign_day.value = day;

        dom.classList.add("on");
    }

})


const relationship = document.querySelector("#relationship");
const enterYearWrapper = document.querySelector("#enter_year_wrapper");
const course_wrapper = document.querySelector("#course_wrapper");

relationship.addEventListener("change", function () {
    if (this.value == "동문") {
        enterYearWrapper.querySelector("select").disabled = false;
        enterYearWrapper.style.display = "block";
        course_wrapper.querySelector("input").disabled = false;
        course_wrapper.style.display = "block";
    } else {
        enterYearWrapper.querySelector("select").disabled = true;
        enterYearWrapper.style.display = "none";
        course_wrapper.querySelector("input").disabled = true;
        course_wrapper.style.display = "none";
    }
})


// 납입방법이 5개라면 flex 때문에 정렬이 이상해짐. 수정해줌
document.addEventListener("DOMContentLoaded", function () {
    if (document.querySelectorAll("#paymentTypes li")) {
        const $li = document.createElement("li");
        $li.style.border = "none";
        document.querySelector("#paymentTypes").appendChild($li);
    }

    const donation_price = Number(document.querySelector("input[name='donation_price']").value.replace(/,/g, ""));
    const lWidth = window.screen.width

    if (donation_price >= 5000000 && lWidth > 768) {
        document.querySelector(".warning-msg").style.display = "inline-block";
        document.querySelector(".divide-input").classList.add("type-required-warning")
    }
})
