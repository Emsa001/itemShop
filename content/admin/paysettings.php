<?php
    session_start();
    if (!isset($_SESSION['logged']))
    {
        header('Location: ./login.php');
        exit();
    }
    error_reporting(0);
	ini_set('display_errors', 0);
    require_once "../../php/connect.php";

    $login = $_SESSION['login'];
    $servername = $_SESSION['servername'];
    // Create connection
    $connect = new mysqli($host, $db_user, $db_password, $db_name);
    mysqli_query($connect, "SET CHARSET utf8");
    mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");

    $sql = "SELECT * FROM serversettings WHERE `servername` = '$servername'";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $przelewy24 = $row['przelewy24'];
            $applepay = $row['applepay'];
            $googlepay = $row['googlepay'];
            $cards = $row['cards'];
        }
    }

?>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

<style>

.form-switch > svg{
    float:right;
}

</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Ustawienia płatności</h1>
    <p class="mb-4">W tej sekcji możesz ustawić metody płatności i ustawienia wypłaty środków dla swojego sklepu.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Metody płatności (Stripe)</h6>
        </div>
        <div class="card-body">
            <div class="row">       
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-12" style="margin-bottom:10px;">
                            <div class="form-check">
                                <div class="form-check form-switch">
                                    <input id="przelewy24" class="form-check-input paymentMethod" type="checkbox" role="switch" id="flexSwitchCheckDefault" <?php echo $przelewy24 ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Przelewy24</label>
                                    <svg class="SVGInline-svg SVGInline--cleaned-svg SVG-svg BrandIcon-svg BrandIcon--size--32-svg" height="32" width="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><path d="M0 0h32v32H0z" fill="#fff"></path><path d="M18.28 21.961l-.155.817h-6.556l.308-1.615c.172-.906.47-1.499.898-1.78.427-.28 1.355-.496 2.784-.647 1.142-.117 1.85-.276 2.12-.478.273-.2.488-.722.648-1.564.14-.738.102-1.217-.117-1.437-.219-.22-.765-.33-1.641-.33-1.094 0-1.8.09-2.12.267-.322.178-.547.607-.675 1.286l-.11.64h-1.007l.092-.445c.195-1.027.555-1.711 1.08-2.053.526-.34 1.48-.512 2.862-.512 1.226 0 2.017.184 2.369.552.352.37.426 1.088.223 2.157-.195 1.027-.521 1.713-.98 2.06-.46.344-1.359.578-2.698.7-1.176.108-1.894.26-2.153.453-.26.192-.474.739-.645 1.64l-.055.29zm8.623-7.748l-1.1 5.783h1.362l-.156.817h-1.36l-.377 1.98h-1.025l.376-1.98H19.53l.215-1.137 5.573-5.463h1.587zm-2.126 5.783l.981-5.16h-.02l-5.208 5.16z" fill="#99a0a6"></path><path d="M3 22.762l1.656-8.652h4.269c1.051 0 1.733.188 2.043.564.31.376.367 1.08.17 2.111-.19.989-.518 1.663-.985 2.021-.467.36-1.25.54-2.346.54l-.411.006H4.705l-.653 3.41zm1.862-4.234h2.493c1.042 0 1.73-.1 2.062-.298.332-.198.566-.655.702-1.369.16-.837.163-1.366.007-1.588-.156-.221-.604-.333-1.347-.333l-.401-.006H5.55z" fill="#d40e2b"></path><path d="M9.143 10.96l-1.013-.671a22.123 22.123 0 0 1 3.717-1.386l.186.914c-.915.26-1.88.632-2.89 1.143zm11.48-.502a10.83 10.83 0 0 0-2.991-1.001L18.449 8h.023c2.362.011 4.24.308 5.72.722l-3.569 1.736zm-13.414.301l1.034.7c-.471.27-.953.571-1.443.905H4.793s.83-.737 2.415-1.605zm10.026-2.708l-.484 1.29a12.352 12.352 0 0 0-4.016.264l-.138-.924c1.52-.358 3.074-.57 4.638-.631zm8.84 1.304C28.215 10.293 29 11.36 29 11.36h-6.92s-.228-.198-.659-.473z" fill="#99a0a6"></path></g></svg>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="col-12" style="margin-bottom:10px;">
                            <div class="form-check">
                                <div class="form-check form-switch">
                                    <input id="applepay" class="form-check-input paymentMethod" type="checkbox" role="switch" id="flexSwitchCheckDefault" <?php echo $applepay ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Apple Pay</label>
                                    <svg class="SVGInline-svg SVGInline--cleaned-svg SVG-svg BrandIcon-svg BrandIcon--size--32-svg" height="32" width="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><path fill="#003663" d="M0 0h32v32H0z"></path><path fill="#FFF" d="M0 0h32v32H0z"></path><g fill-rule="nonzero"><path d="M27.419 7H4.214l-.241.004a3.506 3.506 0 0 0-.525.046c-.176.032-.34.084-.5.165a1.675 1.675 0 0 0-.733.734c-.082.16-.133.323-.165.499-.03.173-.041.35-.046.525L2 9.213V22.66c0 .08.002.16.004.241.005.175.015.352.046.525.032.176.083.34.165.499a1.67 1.67 0 0 0 .734.734c.16.081.323.133.499.164.173.031.35.042.525.047l.24.003h23.492l.242-.003c.174-.005.351-.016.525-.047.175-.031.339-.083.499-.164a1.667 1.667 0 0 0 .733-.734c.082-.16.133-.323.165-.5a3.48 3.48 0 0 0 .046-.524c.002-.08.003-.16.003-.241l.001-.287V9.5v-.286c0-.08-.002-.16-.004-.241a3.482 3.482 0 0 0-.046-.525 1.683 1.683 0 0 0-1.397-1.398 3.515 3.515 0 0 0-.525-.046l-.242-.003L27.42 7z" fill="#000"></path><path d="M27.419 7.596h.282c.076 0 .153.002.23.004.133.003.29.01.435.037.127.023.233.057.335.11a1.078 1.078 0 0 1 .473.473c.051.1.086.206.108.334.026.144.034.3.037.435l.004.23v13.438c0 .076-.002.152-.004.228-.003.134-.01.29-.037.436a1.156 1.156 0 0 1-.109.334 1.079 1.079 0 0 1-.473.473 1.166 1.166 0 0 1-.333.109 3.03 3.03 0 0 1-.434.037c-.077.002-.154.003-.232.003H4.217c-.077 0-.154-.001-.228-.003a3.035 3.035 0 0 1-.436-.037 1.17 1.17 0 0 1-.335-.11 1.069 1.069 0 0 1-.472-.472 1.17 1.17 0 0 1-.11-.335 2.947 2.947 0 0 1-.036-.435 11.135 11.135 0 0 1-.004-.229V9.218c0-.077.001-.153.004-.23.003-.133.01-.289.037-.435.022-.126.057-.232.109-.334a1.075 1.075 0 0 1 .473-.473c.101-.052.207-.086.334-.11.146-.025.302-.033.436-.036l.228-.004H27.42" fill="#FFF"></path><g fill="#000"><g><path d="M9.622 13.012c.239-.3.401-.7.358-1.111-.35.017-.777.23-1.024.53-.222.256-.418.675-.367 1.068.393.034.785-.197 1.033-.487M9.976 13.575c-.57-.034-1.056.324-1.328.324-.273 0-.69-.307-1.141-.298a1.682 1.682 0 0 0-1.43.869c-.613 1.056-.162 2.623.434 3.484.29.425.638.894 1.098.877.434-.017.605-.28 1.132-.28.528 0 .681.28 1.141.272.477-.009.775-.426 1.064-.852.333-.486.469-.954.477-.98-.008-.008-.92-.358-.928-1.405-.008-.878.715-1.295.75-1.32-.41-.605-1.048-.674-1.27-.69"></path></g><g><path d="M14.943 12.388c1.24 0 2.103.855 2.103 2.1 0 1.248-.88 2.107-2.134 2.107h-1.373v2.183h-.992v-6.39h2.396zm-1.404 3.375h1.138c.864 0 1.355-.465 1.355-1.271 0-.806-.491-1.267-1.35-1.267h-1.143v2.538zM17.306 17.454c0-.815.624-1.315 1.731-1.377l1.275-.075v-.359c0-.518-.35-.828-.934-.828-.554 0-.899.266-.983.682h-.903c.053-.842.77-1.462 1.921-1.462 1.13 0 1.851.598 1.851 1.533v3.21h-.916v-.766h-.022c-.27.518-.86.846-1.47.846-.913 0-1.55-.567-1.55-1.404zm3.006-.42v-.368l-1.147.07c-.57.04-.894.293-.894.692 0 .407.336.673.85.673.669 0 1.191-.46 1.191-1.067zM22.13 20.492v-.775c.07.018.23.018.31.018.443 0 .682-.186.828-.664 0-.01.084-.284.084-.288L21.67 14.12h1.036l1.179 3.79h.017l1.178-3.79h1.01l-1.745 4.902c-.398 1.13-.859 1.492-1.824 1.492a3.7 3.7 0 0 1-.39-.022z"></path></g></g></g></g></svg>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="col-12" style="margin-bottom:10px;">
                            <div class="form-check">
                                <div class="form-check form-switch">
                                    <input id="googlepay" class="form-check-input paymentMethod" type="checkbox" role="switch" id="flexSwitchCheckDefault" <?php echo $googlepay ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Google Pay</label>
                                    <svg class="SVGInline-svg SVGInline--cleaned-svg SVG-svg BrandIcon-svg BrandIcon--size--32-svg" height="32" width="32" viewBox="0 0 32 33" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><path d="M0 1h32v32H0z"></path><g fill-rule="nonzero"><path d="M27.865 17.087c0-.785-.065-1.57-.196-2.356H16.673v4.494h6.305a5.34 5.34 0 0 1-2.334 3.535v2.924h3.752a11.41 11.41 0 0 0 3.491-8.597h-.022z" fill="#4285F4"></path><path d="M16.673 28.498c3.142 0 5.803-1.025 7.723-2.814l-3.752-2.924a6.982 6.982 0 0 1-3.971 1.113 6.982 6.982 0 0 1-6.546-4.8H6.244v2.989a11.673 11.673 0 0 0 10.429 6.436z" fill="#34A853"></path><path d="M10.127 19.073a6.982 6.982 0 0 1 0-4.473v-3.01H6.244a11.673 11.673 0 0 0 0 10.472l3.883-2.99z" fill="#FBBC04"></path><path d="M16.673 9.8a6.327 6.327 0 0 1 4.472 1.745l3.339-3.338a11.673 11.673 0 0 0-18.24 3.382l3.883 3.011a6.982 6.982 0 0 1 6.546-4.8z" fill="#EA4335"></path></g></g></svg>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="col-12" style="margin-bottom:10px;">
                            <div class="form-check">
                                <div class="form-check form-switch">
                                    <input id="cards" class="form-check-input paymentMethod" type="checkbox" role="switch" id="flexSwitchCheckDefault" <?php echo $cards ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Cards</label>
                                    <svg class="SVGInline-svg SVGInline--cleaned-svg SVG-svg BrandIcon-svg BrandIcon--size--32-svg" height="32" width="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><path d="M0 0h32v32H0z" fill="#e3e8ee"></path><path d="M26 11H6v-.938C6 9.2 6.56 8.5 7.25 8.5h17.5c.69 0 1.25.7 1.25 1.563zm0 3.125v8.125c0 .69-.56 1.25-1.25 1.25H7.25c-.69 0-1.25-.56-1.25-1.25v-8.125zM11 18.5a1.25 1.25 0 0 0 0 2.5h1.25a1.25 1.25 0 0 0 0-2.5z" fill="#697386"></path></g></svg>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="col-12" style="margin-bottom:10px;">
                            <div class="form-check">
                                <div class="form-check form-switch">
                                    <input id="cartesbacaires" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" disabled>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Cartes Bacaires</label>
                                    <svg class="SVGInline-svg SVGInline--cleaned-svg SVG-svg BrandIcon-svg BrandIcon--size--32-svg" height="32" width="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient x1="84.571%" y1="-2.163%" x2="20.485%" y2="100%" id="sail-svg-3a"><stop stop-color="#002253" offset="0%"></stop><stop stop-color="#0082B1" offset="54.255%"></stop><stop stop-color="#0E9641" offset="100%"></stop></linearGradient></defs><g fill="none" fill-rule="evenodd"><path fill="url(#sail-svg-3a)" d="M0 0h32v32H0z"></path><path d="M17.657 10.009v6.008h9.591a3.004 3.004 0 0 0 0-6.008h-9.59zm-.818 6.008c-.054-1.182-.35-2.242-.846-3.142a5.963 5.963 0 0 0-2.358-2.357c-1.001-.553-2.2-.856-3.546-.856H8.818c-1.345 0-2.545.303-3.546.856a5.963 5.963 0 0 0-2.358 2.357c-.553 1.002-.856 2.201-.856 3.547 0 1.345.303 2.544.856 3.546a5.963 5.963 0 0 0 2.358 2.358c1.001.553 2.2.855 3.546.855h1.27c1.346 0 2.546-.302 3.547-.855a5.963 5.963 0 0 0 2.358-2.358c.497-.9.792-1.96.846-3.142H9.684v-.809h7.155zm.818.809v6.009h9.591a3.004 3.004 0 0 0 0-6.009h-9.59z" fill="#FFF"></path></g></svg>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="col-12" style="margin-bottom:10px;">
                            <div class="form-check">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" disabled>
                                    <label id="bancontact" class="form-check-label" for="flexSwitchCheckDefault">Bancontact</label>
                                    <svg class="SVGInline-svg SVGInline--cleaned-svg SVG-svg BrandIcon-svg BrandIcon--size--32-svg" height="32" width="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><path d="M0 0h32v32H0z" fill="#fff"></path><g fill-rule="nonzero"><path d="M25.64 14.412h-7.664l-.783.896-2.525 2.898-.783.896H6.331l.764-.906.362-.428.763-.907H4.746c-.636 0-1.155.548-1.155 1.205v2.55c0 .666.52 1.204 1.155 1.204h13.328c.637 0 1.508-.398 1.928-.896l2.016-2.33z" fill="#005498"></path><path d="M27.176 11.694c.636 0 1.154.548 1.154 1.205v2.539c0 .667-.518 1.204-1.154 1.204H23.71l.773-.896.382-.448.773-.896h-7.662l-4.081 4.68H6.292l5.451-6.273.206-.239c.43-.488 1.301-.896 1.937-.896h13.29z" fill="#ffbf00"></path></g></g></svg>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="col-12" style="margin-bottom:10px;">
                            <div class="form-check">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" disabled>
                                    <label id="giropay" class="form-check-label" for="flexSwitchCheckDefault">GiroPay</label>
                                    <svg class="SVGInline-svg SVGInline--cleaned-svg SVG-svg BrandIcon-svg BrandIcon--size--32-svg" height="32" width="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><path d="M0 0h32v32H0z" fill="#fff"></path><path d="M4 11.191C4 9.705 5.239 8.5 6.766 8.5h18.468C26.762 8.5 28 9.705 28 11.191v9.618c0 1.486-1.238 2.691-2.766 2.691H6.766C5.239 23.5 4 22.295 4 20.809zm1.02 9.6c0 .944.783 1.71 1.75 1.71h9.213V9.5H6.77c-.967 0-1.75.765-1.75 1.708v9.584zm13.749-.104h2.272v-3.57h.025c.43.782 1.29 1.072 2.084 1.072 1.957 0 3.004-1.615 3.004-3.558 0-1.589-.997-3.319-2.815-3.319-1.035 0-1.994.417-2.45 1.338h-.025v-1.185h-2.095zm5.037-6.005c0 1.047-.518 1.766-1.376 1.766-.758 0-1.39-.72-1.39-1.678 0-.984.556-1.716 1.39-1.716.885 0 1.376.757 1.376 1.627z" fill="#04337b"></path><path d="M14.153 11.463v5.71c0 2.657-1.33 3.515-4.017 3.515a7.958 7.958 0 0 1-2.547-.41l.115-1.764c.703.335 1.292.533 2.253.533 1.33 0 2.047-.607 2.047-1.874v-.348h-.026c-.55.757-1.318 1.105-2.24 1.105-1.83 0-2.969-1.34-2.969-3.252 0-1.924.935-3.366 3.007-3.366.985 0 1.78.523 2.267 1.318h.025v-1.168zM9.15 14.64c0 1.005.616 1.576 1.306 1.576.818 0 1.472-.67 1.472-1.664 0-.72-.435-1.527-1.472-1.527-.857 0-1.306.734-1.306 1.615z" fill="#ee3525"></path></g></svg>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="col-12" style="margin-bottom:10px;">
                            <div class="form-check">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" disabled>
                                    <label id="ideal" class="form-check-label" for="flexSwitchCheckDefault">iDEAL</label>
                                    <svg class="SVGInline-svg SVGInline--cleaned-svg SVG-svg BrandIcon-svg BrandIcon--size--32-svg" height="32" width="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="nonzero"><path fill="#FFF" d="M0 0h32v32H0z"></path><g transform="translate(3 5)"><path d="M0 1.694v19.464c0 .936.758 1.694 1.694 1.694h11.63c8.788 0 12.599-4.922 12.599-11.448C25.923 4.903 22.112 0 13.323 0H1.694C.759 0 0 .758 0 1.694z" fill="#FFF"></path><path d="M13.321 21.296H3.206A1.628 1.628 0 0 1 1.58 19.67V3.182c.001-.898.729-1.625 1.626-1.626h10.115c9.593 0 11.026 6.17 11.026 9.848 0 6.381-3.916 9.892-11.026 9.892zM3.206 2.098c-.598 0-1.084.485-1.085 1.084V19.67c.001.599.487 1.084 1.085 1.084h10.115c6.76 0 10.484-3.32 10.484-9.35 0-8.097-6.569-9.306-10.484-9.306H3.206z" fill="#000"></path><path d="M7.781 4.78v14.377h6.259c5.686 0 8.151-3.213 8.151-7.746 0-4.342-2.465-7.716-8.151-7.716H8.865c-.598 0-1.084.485-1.084 1.084z" fill="#C06"></path><path fill="#FFF" d="M19.713 9.47v2.8h1.674v.635h-2.429V9.47zM17.199 9.47l1.285 3.435H17.7l-.26-.762h-1.285l-.27.762h-.762l1.3-3.435h.776zm.043 2.107l-.433-1.26H16.8l-.447 1.26h.89zM14.612 9.47v.635h-1.814v.736h1.665v.587h-1.665v.842h1.853v.635h-2.607V9.47zM9.985 9.47c.21-.002.42.034.617.106.187.068.356.176.496.318.146.15.257.331.328.529.082.24.122.492.117.746.002.234-.03.467-.096.692-.059.2-.157.387-.29.549-.133.156-.3.28-.487.363-.216.093-.45.138-.685.132H8.503V9.47h1.482zm-.053 2.8a.983.983 0 0 0 .317-.053.703.703 0 0 0 .275-.176.888.888 0 0 0 .192-.319c.052-.155.076-.318.072-.481a2.04 2.04 0 0 0-.05-.47.932.932 0 0 0-.17-.357.74.74 0 0 0-.305-.23 1.212 1.212 0 0 0-.47-.079h-.538v2.165h.677z"></path><path d="M4.953 13.683a1.2 1.2 0 0 1 1.2 1.2v4.274a2.401 2.401 0 0 1-2.401-2.401v-1.872a1.2 1.2 0 0 1 1.2-1.2z" fill="#000"></path><circle fill="#000" cx="4.953" cy="11.188" r="1.585"></circle></g></g></svg>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="col-12" style="margin-bottom:10px;">
                            <div class="form-check">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" disabled>
                                    <label id="sofort" class="form-check-label" for="flexSwitchCheckDefault">Sofort</label>
                                    <svg class="SVGInline-svg SVGInline--cleaned-svg SVG-svg BrandIcon-svg BrandIcon--size--32-svg" height="32" width="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><path d="M0 0h32v32H0z" fill="#ffb3c7"></path><path d="M16.279 7c0 3.307-1.501 6.342-4.124 8.323l-1.573 1.2 6.126 8.442h5.034l-5.638-7.77C18.777 14.504 20.27 10.888 20.27 7zM6 7h4.087v17.965H6zm16.382 15.665c0-1.289 1.034-2.335 2.309-2.335S27 21.376 27 22.665C27 23.955 25.966 25 24.69 25s-2.308-1.046-2.308-2.335z" fill="#0a0b09" fill-rule="nonzero"></path></g></svg>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="col-12" style="margin-bottom:10px;">
                            <div class="form-check">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" disabled>
                                    <label id="sepadirectdebit" class="form-check-label" for="flexSwitchCheckDefault">SEPA Direct Debit</label>
                                    <svg class="SVGInline-svg SVGInline--cleaned-svg SVG-svg BrandIcon-svg BrandIcon--size--32-svg" height="32" width="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><path d="M0 0h32v32H0z" fill="#10298d"></path><path d="M27.485 18.42h-2.749l-.37 1.342H22.24L24.533 12h3.104l2.325 7.762h-2.083l-.393-1.342zm-.408-1.512l-.963-3.364-.936 3.364zm-10.452 2.854V12h3.83c.526 0 .928.044 1.203.13.63.202 1.052.612 1.27 1.233.111.325.167.816.167 1.47 0 .788-.06 1.354-.183 1.699-.247.68-.753 1.072-1.517 1.175-.09.015-.472.028-1.146.04l-.341.011H18.68v2.004zm2.056-3.805h1.282c.407-.015.653-.047.744-.096.12-.068.202-.204.242-.408.026-.136.04-.337.04-.604 0-.329-.026-.573-.079-.732-.073-.222-.25-.358-.53-.407a3.91 3.91 0 0 0-.4-.011h-1.299zm-10.469-1.48H6.3c0-.32-.038-.534-.11-.642-.114-.162-.43-.242-.942-.242-.5 0-.831.046-.993.139-.161.093-.242.296-.242.608 0 .283.072.469.215.558a.91.91 0 0 0 .408.112l.386.026c.517.033 1.033.072 1.55.119.654.066 1.126.243 1.421.53.231.222.37.515.414.875.025.216.037.46.037.73 0 .626-.057 1.083-.175 1.374-.213.532-.693.868-1.437 1.009-.312.06-.788.089-1.43.089-1.072 0-1.819-.064-2.24-.196-.517-.158-.858-.482-1.024-.969-.092-.269-.137-.72-.137-1.353h1.914v.162c0 .337.096.554.287.65.13.067.29.101.477.106h.704c.359 0 .587-.019.687-.056a.57.57 0 0 0 .346-.34 1.38 1.38 0 0 0 .044-.374c0-.341-.123-.55-.368-.624-.092-.03-.52-.071-1.28-.123a15.411 15.411 0 0 1-1.274-.128c-.626-.119-1.044-.364-1.252-.736-.184-.315-.275-.793-.275-1.432 0-.487.05-.877.148-1.17.1-.294.258-.517.48-.669.321-.234.735-.371 1.237-.412.463-.04.927-.058 1.391-.056.803 0 1.375.046 1.717.14.833.227 1.248.863 1.248 1.909a5.8 5.8 0 0 1-.018.385z" fill="#fff"></path><path d="M13.786 13.092c.849 0 1.605.398 2.103 1.02l.444-.966a3.855 3.855 0 0 0-2.678-1.077c-1.62 0-3.006.995-3.575 2.402h-.865l-.51 1.111h1.111c-.018.23-.017.46.006.69h-.56l-.51 1.111h1.354a3.853 3.853 0 0 0 3.549 2.335c.803 0 1.55-.244 2.167-.662v-1.363a2.683 2.683 0 0 1-2.036.939 2.7 2.7 0 0 1-2.266-1.248h2.832l.511-1.112h-3.761a2.886 2.886 0 0 1-.016-.69h4.093l.51-1.11h-4.25a2.704 2.704 0 0 1 2.347-1.38" fill="#ffcc02"></path></g></svg>
                                </div>
                            </div>
                        </div>
                        <hr />
                    </div>  
                </div>
                <div class="col-md-6 offset-md-1">
                    <div class="card">
                        <div class="card-body">
                            <h4>Regulamin płatności</h4>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.paymentMethod').on('change', function(e) {
		$(`<form action="./php/serverupdates.php" method="post"><input id="p_method" name="p_method" value='${e.target.id}'/><input id="p_change" name="p_change" value='${e.target.checked}'/></form>`).appendTo('body').submit();
	});

</script>
