@extends('layouts.app')

@section('title', 'Business Categories')

@section('content')

<style>
.categories-page {
    width: 100%;
    max-width: 100%;
    margin: 0 auto;
    color: #315d6d;
}

.categories-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    margin-bottom: 24px;
}

.categories-header-left {
    min-width: 0;
    display: flex;
    align-items: center;
    gap: 15px;
}

.categories-header-icon {
    width: 52px;
    height: 52px;
    min-width: 52px;
    border-radius: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #075374, #00739a);
    color: #fff;
    font-size: 23px;
    box-shadow: 0 7px 18px rgba(0, 83, 116, .15);
}

.categories-header-text {
    min-width: 0;
}

.categories-eyebrow {
    color: #00739a;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    margin-bottom: 5px;
}

.categories-header h1 {
    margin: 0;
    color: #123f52;
    font-size: 27px;
    font-weight: 700;
    line-height: 1.2;
}

.categories-header p {
    margin: 7px 0 0;
    color: #6f8f9c;
    font-size: 14px;
    line-height: 1.55;
    max-width: 700px;
}

.add-category-btn {
    flex-shrink: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 43px;
    padding: 0 18px;
    border: none;
    border-radius: 9px;
    background: linear-gradient(135deg, #075374, #00739a);
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    box-shadow: 0 6px 14px rgba(0, 83, 116, .15);
    transition: all .2s ease;
    cursor: pointer;
    white-space: nowrap;
}

.add-category-btn:hover {
    color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 8px 18px rgba(0, 83, 116, .22);
}

.add-category-btn i {
    font-size: 15px;
}

.category-alert {
    width: 100%;
    border-radius: 10px;
    padding: 13px 16px;
    margin-bottom: 18px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    font-weight: 600;
    line-height: 1.45;
    box-shadow: 0 4px 12px rgba(0, 0, 0, .05);
}

.category-alert span {
    flex: 1;
    min-width: 0;
}

.category-alert.category-alert-success {
    background: #e9f8ef !important;
    border: 1px solid #b9e7c9 !important;
    color: #176b38 !important;
}

.category-alert.category-alert-success i {
    color: #198754 !important;
    font-size: 17px;
    flex-shrink: 0;
}

.category-alert.category-alert-success span {
    color: #176b38 !important;
}

.category-alert.category-alert-error {
    background: #fdecec !important;
    border: 1px solid #f2bcbc !important;
    color: #a52834 !important;
}

.category-alert.category-alert-error i {
    color: #dc3545 !important;
    font-size: 17px;
    flex-shrink: 0;
}

.category-alert.category-alert-error span {
    color: #a52834 !important;
}

.categories-panel {
    background: #fff;
    border: 1px solid #dceef3;
    border-radius: 15px;
    box-shadow: 0 5px 18px rgba(31, 81, 101, .06);
    overflow: hidden;
}
.categories-panel-header {
    padding: 19px 22px;
    border-bottom: 1px solid #e5f1f4;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
}

.categories-panel-title {
    min-width: 0;
    display: flex;
    align-items: center;
    gap: 11px;
}

.categories-panel-title-icon {
    width: 38px;
    height: 38px;
    min-width: 38px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eff9fc;
    color: #00739a;
    font-size: 18px;
}

.categories-panel-title-text {
    min-width: 0;
}

.categories-panel-title h3 {
    margin: 0;
    color: #174c60;
    font-size: 16px;
    font-weight: 700;
    line-height: 1.3;
}

.categories-panel-title p {
    margin: 4px 0 0;
    color: #809daa;
    font-size: 12px;
    line-height: 1.4;
}

.category-count {
    flex-shrink: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 35px;
    height: 28px;
    padding: 0 9px;
    border-radius: 20px;
    background: #eff9fc;
    color: #00739a;
    font-size: 14px;
    font-weight: 700;
}

.categories-table-wrapper {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.categories-table {
    width: 100%;
    min-width: 650px;
    margin: 0;
    border-collapse: collapse;
}

.categories-table thead th {
    background: #f7fbfc;
    color: #658896;
    border-bottom: 1px solid #e2eef2;
    padding: 13px 20px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .6px;
    white-space: nowrap;
}

.categories-table tbody td {
    padding: 15px 20px;
    border-bottom: 1px solid #edf4f6;
    color: #466f7e;
    font-size: 14px;
    vertical-align: middle;
}

.categories-table tbody tr:last-child td {
    border-bottom: none;
}

.categories-table tbody tr {
    transition: background .15s ease;
}

.categories-table tbody tr:hover {
    background: #fafdfe;
}

.category-number {
    width: 55px;
    color: #8ba5b0 !important;
    font-weight: 600;
}

.category-name-wrapper {
    display: flex;
    align-items: center;
    gap: 11px;
    min-width: 200px;
}

.category-icon {
    width: 35px;
    height: 35px;
    min-width: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    background: #eff9fc;
    color: #00739a;
    font-size: 16px;
}

.category-name {
    color: #174c60;
    font-weight: 600;
    font-size: 13px;
    line-height: 1.4;
    overflow-wrap: anywhere;
}

.business-count {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 10px;
    border-radius: 20px;
    background: #f1f8fa;
    color: #527789;
    font-size: 14px;
    font-weight: 600;
    white-space: nowrap;
}

.business-count i {
    color: #00739a;
}

.delete-category-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    min-height: 35px;
    padding: 0 12px;
    border: 1px solid #f0cfd2;
    border-radius: 7px;
    background: #fff;
    color: #c34e58;
    font-size: 14px;
    font-weight: 600;
    transition: all .2s ease;
    cursor: pointer;
}

.delete-category-btn:hover {
    background: #fff4f4;
    border-color: #e7aeb3;
    color: #b63c47;
}

.category-empty {
    padding: 55px 20px !important;
    text-align: center;
}

.category-empty-icon {
    width: 58px;
    height: 58px;
    margin: 0 auto 12px;
    border-radius: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eff9fc;
    color: #6c9aaa;
    font-size: 25px;
}

.category-empty h4 {
    margin: 0 0 6px;
    color: #416b7b;
    font-size: 14px;
    font-weight: 700;
}

.category-empty p {
    margin: 0 auto;
    max-width: 420px;
    color: #8aa3ad;
    font-size: 14px;
    line-height: 1.5;
}
.mobile-category-list {
    display: none;
}

.mobile-category-card {
    padding: 16px;
    border-bottom: 1px solid #edf4f6;
}

.mobile-category-card:last-child {
    border-bottom: none;
}

.mobile-category-top {
    display: flex;
    align-items: center;
    gap: 12px;
}

.mobile-category-number {
    width: 28px;
    min-width: 28px;
    height: 28px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f1f8fa;
    color: #7896a1;
    font-size: 14px;
    font-weight: 700;
}

.mobile-category-info {
    flex: 1;
    min-width: 0;
}

.mobile-category-name {
    color: #174c60;
    font-size: 14px;
    font-weight: 700;
    line-height: 1.35;
    overflow-wrap: anywhere;
}

.mobile-category-businesses {
    margin-top: 5px;
}

.mobile-category-action {
    margin-top: 13px;
    display: flex;
    justify-content: flex-end;
}
.mobile-category-action .delete-category-btn {
    width: 100%;
    min-height: 40px;
    font-size: 14px;
}
.category-modal-overlay {
    position: fixed;
    inset: 0;
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
    background: rgba(15, 46, 58, .55);
    backdrop-filter: blur(2px);
    -webkit-backdrop-filter: blur(2px);
    opacity: 0;
    transition: opacity .2s ease;
}
.category-modal-overlay.show {
    display: flex;
    opacity: 1;
}
.category-modal-box {
    width: 100%;
    max-width: 430px;
    max-height: calc(100vh - 40px);
    overflow-y: auto;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 25px 60px rgba(20, 69, 87, .28);
    transform: translateY(-15px) scale(.97);
    transition: transform .2s ease;
}
.category-modal-overlay.show .category-modal-box {
    transform: translateY(0) scale(1);
}
.category-modal-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px;
    padding: 18px 20px;
    background: linear-gradient(135deg, #075374, #00739a);
    color: #fff;
}

.category-modal-heading {
    min-width: 0;
    display: flex;
    align-items: center;
    gap: 11px;
}

.category-modal-icon {
    width: 38px;
    height: 38px;
    min-width: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    background: rgba(255,255,255,.14);
    color: #fff;
    font-size: 17px;
}

.category-modal-title-area {
    min-width: 0;
    display: flex;
    flex-direction: column;
}

.category-modal-eyebrow {
    margin-bottom: 3px;
    color: rgba(255,255,255,.68);
    font-size: 9px;
    font-weight: 700;
    letter-spacing: 1.3px;
    text-transform: uppercase;
}

.category-modal-title {
    margin: 0;
    color: #fff;
    font-size: 16px;
    font-weight: 700;
    line-height: 1.3;
}

.category-modal-close {
    width: 32px;
    height: 32px;
    min-width: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    border-radius: 7px;
    background: rgba(255,255,255,.10);
    color: #fff;
    font-size: 17px;
    cursor: pointer;
    transition: all .2s ease;
}

.category-modal-close:hover {
    background: rgba(255,255,255,.20);
}

.category-modal-body {
    padding: 23px 21px 20px;
}

.category-modal-label {
    display: block;
    margin-bottom: 8px;
    color: #3f6978;
    font-size: 14px;
    font-weight: 700;
}

.category-modal-label i {
    color: #00739a;
    margin-right: 5px;
}

.category-input-wrapper {
    position: relative;
}

.category-input-wrapper i {
    position: absolute;
    left: 13px;
    top: 50%;
    transform: translateY(-50%);
    color: #75a4b3;
    font-size: 15px;
    pointer-events: none;
}

.category-modal-input {
    width: 100%;
    height: 45px;
    padding: 0 13px 0 38px;
    border: 1px solid #c9e3ea;
    border-radius: 9px;
    outline: none;
    color: #315d6d;
    background: #fff;
    font-size: 14px;
    box-shadow: none;
    transition: all .2s ease;
    box-sizing: border-box;
}

.category-modal-input:hover {
    border-color: #9fcbd6;
}

.category-modal-input:focus {
    border-color: #58abc2;
    box-shadow: 0 0 0 3px rgba(0,115,154,.09);
}

.category-modal-input::placeholder {
    color: #a0b6be;
}

.category-modal-hint {
    display: flex;
    align-items: flex-start;
    gap: 5px;
    margin-top: 9px;
    color: #8aa3ad;
    font-size: 14px;
    line-height: 1.5;
}

.category-modal-hint i {
    color: #00739a;
    margin-top: 1px;
}

.category-modal-input.is-invalid {
    border-color: #dc5965;
}
.category-modal-error {
    display: block;
    margin-top: 6px;
    color: #c34e58;
    font-size: 14px;
}
.category-modal-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 8px;
    padding: 14px 20px;
    border-top: 1px solid #e8f2f5;
    background: #fbfdfe;
}

.category-cancel-btn,
.category-save-btn {
    min-height: 39px;
    padding: 0 16px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all .2s ease;
}

.category-cancel-btn {
    border: 1px solid #d7e7eb;
    background: #fff;
    color: #64838e;
}

.category-cancel-btn:hover {
    background: #f5fafb;
    border-color: #bfd8df;
    color: #476d79;
}

.category-save-btn {
    border: none;
    background: #075374;
    color: #fff;
}

.category-save-btn:hover {
    background: #064762;
    color: #fff;
    transform: translateY(-1px);
}

.category-save-btn i {
    margin-right: 4px;
}
.confirm-modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(15, 46, 58, .52);
    backdrop-filter: blur(2px);
    -webkit-backdrop-filter: blur(2px);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 10000;
    padding: 20px;
}

.confirm-modal-overlay.show {
    display: flex;
}

.confirm-modal-box {
    width: 100%;
    max-width: 500px;
    background: #fff;
    border-radius: 14px;
    padding: 32px 30px 30px;
    text-align: center;
    box-shadow: 0 20px 50px rgba(0, 0, 0, .20);
    animation: confirmModalShow .2s ease-out;
}

@keyframes confirmModalShow {
    from {
        opacity: 0;
        transform: scale(.94);
    }

    to {
        opacity: 1;
        transform: scale(1);
    }
}

.confirm-icon {
    width: 82px;
    height: 82px;
    margin: 0 auto 18px;
    border: 3px solid #ef3d32;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ef3d32;
}

.confirm-icon i {
    font-size: 48px;
    font-weight: 800;
    line-height: 1;
}

.confirm-modal-box h2 {
    margin: 0 0 12px;
    font-size: 30px;
    font-weight: 700;
    color: #173f50;
}

.confirm-modal-box p {
    margin: 0 auto 25px;
    max-width: 400px;
    font-size: 16px;
    line-height: 1.55;
    color: #526f7a;
}


.confirm-modal-actions {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 12px;
}

.confirm-btn {
    min-width: 145px;
    min-height: 44px;
    padding: 0 20px;
    border: none;
    border-radius: 7px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition:
        transform .15s ease,
        box-shadow .15s ease,
        background .15s ease;
}

.confirm-btn:hover {
    transform: translateY(-1px);
}

.confirm-btn:active {
    transform: translateY(0);
}

.confirm-btn-primary {
    background: #3288b8;
    color: #fff;
    box-shadow: 0 3px 7px rgba(50, 136, 184, .25);
}

.confirm-btn-primary:hover {
    background: #287ba9;
}

.confirm-btn-danger {
    background: #f33b2f;
    color: #fff;
    box-shadow: 0 3px 7px rgba(243, 59, 47, .25);
}
.confirm-btn-danger:hover {
    background: #dc3025;
}

@media (max-width: 992px) {

    .categories-header {
        align-items: flex-start;
    }

    .categories-header h1 {
        font-size: 25px;
    }

    .categories-header p {
        max-width: 520px;
    }

    .categories-table thead th,
    .categories-table tbody td {
        padding-left: 14px;
        padding-right: 14px;
    }
}
@media (max-width: 768px) {

    .categories-header {
        flex-direction: column;
        align-items: stretch;
        gap: 17px;
        margin-bottom: 20px;
    }

    .categories-header-left {
        align-items: flex-start;
    }

    .categories-header-icon {
        width: 46px;
        height: 46px;
        min-width: 46px;
        border-radius: 11px;
        font-size: 20px;
    }

    .categories-header h1 {
        font-size: 23px;
    }

    .categories-header p {
        font-size: 12px;
        line-height: 1.5;
    }

    .add-category-btn {
        width: 100%;
        min-height: 44px;
    }

    .categories-panel {
        border-radius: 12px;
    }

    .categories-panel-header {
        padding: 16px;
    }

    .categories-panel-title h3 {
        font-size: 15px;
    }

    .categories-panel-title p {
        font-size: 11px;
    }

    .categories-table-wrapper {
        overflow-x: auto;
    }

    .categories-table {
        min-width: 600px;
    }

    .delete-category-btn {
        min-width: 36px;
    }
}


@media (max-width: 576px) {

    .categories-page {
        width: 100%;
    }

    .categories-header {
        margin-bottom: 18px;
    }

    .categories-header-left {
        gap: 11px;
    }

    .categories-header-icon {
        width: 42px;
        height: 42px;
        min-width: 42px;
        border-radius: 10px;
        font-size: 18px;
    }

    .categories-eyebrow {
        font-size: 9px;
        letter-spacing: 1.2px;
    }

    .categories-header h1 {
        font-size: 21px;
    }

    .categories-header p {
        margin-top: 5px;
        font-size: 11.5px;
    }

    .category-alert {
        padding: 12px;
        font-size: 12px;
        align-items: flex-start;
    }

    .category-alert i {
        margin-top: 1px;
    }

    .categories-panel-header {
        padding: 14px;
    }

    .categories-panel-title {
        gap: 9px;
    }

    .categories-panel-title-icon {
        width: 34px;
        height: 34px;
        min-width: 34px;
        font-size: 16px;
    }

    .categories-panel-title h3 {
        font-size: 14px;
    }

    .categories-panel-title p {
        display: none;
    }

    .category-count {
        min-width: 32px;
        height: 26px;
        font-size: 11px;
    }
    .categories-table-wrapper {
        display: none;
    }

    .mobile-category-list {
        display: block;
    }

    .category-empty {
        padding: 40px 18px !important;
    }

    .category-empty-icon {
        width: 52px;
        height: 52px;
        font-size: 22px;
    }

    .category-empty h4 {
        font-size: 13px;
    }

    .category-empty p {
        font-size: 11px;
    }

    .category-modal-overlay {
        padding: 12px;
    }

    .category-modal-box {
        max-width: 100%;
        max-height: calc(100vh - 24px);
        border-radius: 13px;
    }

    .category-modal-header {
        padding: 15px;
    }

    .category-modal-icon {
        width: 35px;
        height: 35px;
        min-width: 35px;
    }

    .category-modal-title {
        font-size: 15px;
    }

    .category-modal-body {
        padding: 19px 16px;
    }

    .category-modal-footer {
        padding: 12px 16px;
    }
    .category-cancel-btn,
    .category-save-btn {
        flex: 1;
        min-height: 42px;
    }

    .confirm-modal-overlay {
        padding: 14px;
    }

    .confirm-modal-box {
        max-width: 100%;
        padding: 27px 18px 22px;
        border-radius: 13px;
    }

    .confirm-icon {
        width: 68px;
        height: 68px;
        margin-bottom: 15px;
    }

    .confirm-icon i {
        font-size: 40px;
    }

    .confirm-modal-box h2 {
        font-size: 25px;
        margin-bottom: 10px;
    }

    .confirm-modal-box p {
        font-size: 14px;
        margin-bottom: 20px;
    }

    .confirm-modal-actions {
        flex-direction: column;
        gap: 9px;
    }

    .confirm-btn {
        width: 100%;
        min-width: 0;
        min-height: 43px;
        font-size: 14px;
    }
}
@media (max-width: 380px) {

    .categories-header h1 {
        font-size: 19px;
    }

    .categories-header p {
        font-size: 14px;
    }

    .add-category-btn {
        font-size: 14px;
    }

    .mobile-category-card {
        padding: 14px;
    }

    .mobile-category-name {
        font-size: 14px;
    }

    .mobile-category-action .delete-category-btn {
        min-height: 38px;
        font-size: 14px;
    }

    .category-modal-footer {
        flex-direction: column;
    }

    .category-cancel-btn,
    .category-save-btn {
        width: 100%;
    }
}
button,
input {
    -webkit-tap-highlight-color: transparent;
}

button:focus-visible,
input:focus-visible {
    outline: 3px solid rgba(0, 115, 154, .18);
    outline-offset: 2px;
}

@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: .01ms !important;
        transition-duration: .01ms !important;
    }
}
</style>

<div class="categories-page">
<div class="categories-header">
    <div class="categories-header-left">
        <div class="categories-header-icon">
            <i class="bi bi-tags"></i>
        </div>
        <div class="categories-header-text">
            <div class="categories-eyebrow">
                SYSTEM SETTINGS
            </div>
            <h1>Business Categories</h1>
            <p>
                Manage the business categories available during business registration.
            </p>
        </div>
    </div>

    <button type="button"
            class="add-category-btn"
            id="openAddCategory">

        <i class="bi bi-plus-lg"></i>
        <span>Add Category</span>

    </button>

</div>

@if(session('category_success'))

    <div class="category-alert category-alert-success">

        <i class="bi bi-check-circle-fill"></i>

        <span>
            {{ session('category_success') }}
        </span>

    </div>

@endif


@if(session('category_error'))

    <div class="category-alert category-alert-error">

        <i class="bi bi-exclamation-circle-fill"></i>

        <span>
            {{ session('category_error') }}
        </span>

    </div>

@endif
<div class="categories-panel">
    <div class="categories-panel-header">
        <div class="categories-panel-title">
            <div class="categories-panel-title-icon">
                <i class="bi bi-list-ul"></i>
            </div>

            <div class="categories-panel-title-text">

                <h3>
                    Available Categories
                </h3>

                <p>
                    Categories currently available for business registration.
                </p>

            </div>

        </div>

        <span class="category-count">
            {{ $categories->count() }}
        </span>

    </div>

    <div class="categories-table-wrapper">

        <table class="categories-table">

            <thead>

                <tr>

                    <th>#</th>

                    <th>
                        Category Name
                    </th>

                    <th>
                        Businesses
                    </th>

                    <th class="text-end">
                        Action
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($categories as $category)

                    <tr>

                        <td class="category-number">
                            {{ $loop->iteration }}
                        </td>

                        <td>

                            <div class="category-name-wrapper">

                                <div class="category-icon">
                                    <i class="bi bi-tag"></i>
                                </div>

                                <span class="category-name">
                                    {{ $category->name }}
                                </span>

                            </div>

                        </td>

                        <td>

                            <span class="business-count">

                                <i class="bi bi-building"></i>

                                {{ $category->businesses_count ?? 0 }}

                                {{ ($category->businesses_count ?? 0) == 1
                                    ? 'Business'
                                    : 'Businesses' }}

                            </span>

                        </td>

                        <td class="text-end">

                            <form method="POST"
                                  action="{{ route('settings.business-categories.destroy', $category->id) }}"
                                  class="d-inline category-delete-form">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="delete-category-btn">

                                    <i class="bi bi-trash3"></i>

                                    <span>
                                        Delete
                                    </span>

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4"
                            class="category-empty">

                            <div class="category-empty-icon">
                                <i class="bi bi-tags"></i>
                            </div>

                            <h4>
                                No Business Categories
                            </h4>

                            <p>
                                Add a business category to make it available during registration.
                            </p>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mobile-category-list">

        @forelse($categories as $category)

            <div class="mobile-category-card">

                <div class="mobile-category-top">

                    <div class="mobile-category-number">
                        {{ $loop->iteration }}
                    </div>

                    <div class="category-icon">
                        <i class="bi bi-tag"></i>
                    </div>

                    <div class="mobile-category-info">

                        <div class="mobile-category-name">
                            {{ $category->name }}
                        </div>

                        <div class="mobile-category-businesses">

                            <span class="business-count">

                                <i class="bi bi-building"></i>

                                {{ $category->businesses_count ?? 0 }}

                                {{ ($category->businesses_count ?? 0) == 1
                                    ? 'Business'
                                    : 'Businesses' }}

                            </span>

                        </div>

                    </div>

                </div>


                <div class="mobile-category-action">

                    <form method="POST"
                          action="{{ route('settings.business-categories.destroy', $category->id) }}"
                          class="w-100 category-delete-form">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="delete-category-btn">

                            <i class="bi bi-trash3"></i>

                            <span>
                                Delete Category
                            </span>

                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="category-empty">

                <div class="category-empty-icon">
                    <i class="bi bi-tags"></i>
                </div>

                <h4>
                    No Business Categories
                </h4>

                <p>
                    Add a business category to make it available during registration.
                </p>

            </div>

        @endforelse

    </div>

</div>

</div>
<div class="category-modal-overlay"
     id="addCategoryModal"
     aria-hidden="true">
<div class="category-modal-box"
     role="dialog"
     aria-modal="true"
     aria-labelledby="addCategoryModalLabel">

    <div class="category-modal-header">

        <div class="category-modal-heading">

            <div class="category-modal-icon">
                <i class="bi bi-tag-fill"></i>
            </div>

            <div class="category-modal-title-area">

                <div class="category-modal-eyebrow">
                    BUSINESS SETTINGS
                </div>

                <h2 class="category-modal-title"
                    id="addCategoryModalLabel">

                    Add New Category

                </h2>

            </div>

        </div>

        <button type="button"
                class="category-modal-close"
                id="closeAddCategory"
                aria-label="Close">

            <i class="bi bi-x-lg"></i>

        </button>

    </div>


    <form method="POST"
          action="{{ route('settings.business-categories.store') }}"
          id="addCategoryForm">

        @csrf

        <div class="category-modal-body">

            <label for="categoryName"
                   class="category-modal-label">

                <i class="bi bi-tag"></i>
                Category Name

            </label>

            <div class="category-input-wrapper">

                <i class="bi bi-pencil"></i>

                <input type="text"
                       name="name"
                       id="categoryName"
                       class="category-modal-input @error('name') is-invalid @enderror"
                       value="{{ old('name') }}"
                       placeholder="Enter category name"
                       maxlength="100"
                       autocomplete="off"
                       required>

            </div>

            @error('name')

                <div class="category-modal-error">
                    {{ $message }}
                </div>
            @enderror

            <div class="category-modal-hint">

                <i class="bi bi-info-circle"></i>

                <span>
                    Example: Retail Store, Sari-Sari Store, Restaurant
                </span>

            </div>

        </div>


        <div class="category-modal-footer">

            <button type="button"
                    class="category-cancel-btn"
                    id="cancelAddCategory">

                Cancel

            </button>

            <button type="submit"
                    class="category-save-btn">

                <i class="bi bi-check-lg"></i>
                Add Category

            </button>
       </div>
    </form>
</div>
</div>

<div class="confirm-modal-overlay"
     id="addCategoryConfirmModal"
     aria-hidden="true">
<div class="confirm-modal-box">

    <div class="confirm-icon">
        <i class="bi bi-exclamation-lg"></i>
    </div>

    <h2>
        Confirm
    </h2>

    <p>
        Are you sure you want to add this category?
    </p>

    <div class="confirm-modal-actions">

        <button type="button"
                class="confirm-btn confirm-btn-primary"
                id="confirmAddCategory">

            Yes, Add!

        </button>

        <button type="button"
                class="confirm-btn confirm-btn-danger"
                id="cancelAddCategoryConfirm">

            Cancel
        </button>
    </div>
</div>
</div>
<div class="confirm-modal-overlay"
     id="deleteCategoryConfirmModal"
     aria-hidden="true">
<div class="confirm-modal-box">

    <div class="confirm-icon">
        <i class="bi bi-exclamation-lg"></i>
    </div>

    <h2>
        Confirm
    </h2>

    <p>
        Are you sure you want to delete this category?
    </p>

    <div class="confirm-modal-actions">

        <button type="button"
                class="confirm-btn confirm-btn-primary"
                id="confirmDeleteCategory">

            Yes, Delete!

        </button>

        <button type="button"
                class="confirm-btn confirm-btn-danger"
                id="cancelDeleteCategory">
            Cancel 
        </button>
    </div>

</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const openButton = document.getElementById('openAddCategory');
    const closeButton = document.getElementById('closeAddCategory');
    const cancelButton = document.getElementById('cancelAddCategory');
    const addModal = document.getElementById('addCategoryModal');
    const categoryInput = document.getElementById('categoryName');

    function openCategoryModal() {

        if (!addModal) {
            return;
        }

        addModal.classList.add('show');
        addModal.setAttribute('aria-hidden', 'false');

        document.body.style.overflow = 'hidden';

        setTimeout(function () {

            if (categoryInput) {
                categoryInput.focus();
            }

        }, 200);
    }


    function closeCategoryModal() {

        if (!addModal) {
            return;
        }

        addModal.classList.remove('show');
        addModal.setAttribute('aria-hidden', 'true');

        document.body.style.overflow = '';
    }


    if (openButton) {

        openButton.addEventListener('click', function (event) {

            event.preventDefault();

            openCategoryModal();

        });

    }


    if (closeButton) {

        closeButton.addEventListener('click', function (event) {

            event.preventDefault();

            closeCategoryModal();

        });

    }


    if (cancelButton) {

        cancelButton.addEventListener('click', function (event) {

            event.preventDefault();

            closeCategoryModal();

        });

    }


    if (addModal) {

        addModal.addEventListener('click', function (event) {

            if (event.target === addModal) {

                closeCategoryModal();
            }
        });
    }

    const addConfirmModal =
        document.getElementById('addCategoryConfirmModal');

    const deleteConfirmModal =
        document.getElementById('deleteCategoryConfirmModal');

    const addForm =
        document.getElementById('addCategoryForm');

    const confirmAddButton =
        document.getElementById('confirmAddCategory');

    const cancelAddConfirmButton =
        document.getElementById('cancelAddCategoryConfirm');

    const confirmDeleteButton =
        document.getElementById('confirmDeleteCategory');

    const cancelDeleteButton =
        document.getElementById('cancelDeleteCategory');

    let deleteFormToSubmit = null;


    function openConfirmModal(modal) {
        if (!modal) {
            return;
        }
        modal.classList.add('show');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeConfirmModal(modal) {
        if (!modal) {
            return;
        }
        modal.classList.remove('show');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    if (addForm) {
        addForm.addEventListener('submit', function (event) {
            event.preventDefault();
            closeCategoryModal();
            openConfirmModal(addConfirmModal);
        });
    }

    if (confirmAddButton) {
        confirmAddButton.addEventListener('click', function () {
            if (addForm) {
                addForm.submit();
            }
        });
    }

    if (cancelAddConfirmButton) {
        cancelAddConfirmButton.addEventListener('click', function () {
            closeConfirmModal(addConfirmModal);
            setTimeout(function () {
                openCategoryModal();
            }, 100);
        });
    }
    document.querySelectorAll('.category-delete-form')
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                deleteFormToSubmit = form;
                openConfirmModal(deleteConfirmModal);

            });
        });
    
    if (confirmDeleteButton) {
        confirmDeleteButton.addEventListener('click', function () {
            if (deleteFormToSubmit) {
                deleteFormToSubmit.submit();
            }
        });
    }

    if (cancelDeleteButton) {
        cancelDeleteButton.addEventListener('click', function () {
            deleteFormToSubmit = null;
            closeConfirmModal(deleteConfirmModal);
        });

    }

    if (addConfirmModal) {
        addConfirmModal.addEventListener('click', function (event) {
            if (event.target === addConfirmModal) {
                closeConfirmModal(addConfirmModal);

            }
        });
    }

    if (deleteConfirmModal) {
        deleteConfirmModal.addEventListener('click', function (event) {
            if (event.target === deleteConfirmModal) {
                deleteFormToSubmit = null;
                closeConfirmModal(deleteConfirmModal);
            }
        });
    }

    document.addEventListener('keydown', function (event) {

        if (event.key !== 'Escape') {
            return;
        }

        if (addModal && addModal.classList.contains('show')) {
            closeCategoryModal();
        }

        if (addConfirmModal &&
            addConfirmModal.classList.contains('show')) {
            closeConfirmModal(addConfirmModal);
        }

        if (deleteConfirmModal &&
            deleteConfirmModal.classList.contains('show')) {
            deleteFormToSubmit = null;
            closeConfirmModal(deleteConfirmModal);
        }
    });

    @if($errors->has('name'))
        openCategoryModal();
    @endif

});
</script>

@endsection
