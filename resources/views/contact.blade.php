@extends('layouts.master')
@section('title',config('app.name', 'Laravel').' - Contacto')
@section('body_class', 'contact')
@section('navbar')
@include('navbar.contact')
@endsection
@section('content')
<section id="contact" class="sceneElement" data-viewport="1">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="contact-text">
                <h2>Hacemos tangible vuestras ideas</h2>
                <p>
                    Hacemos tangible las pequeñas cosas que hayáis imaginado.<br />
                    Envíanos una consulta o un par de líneas…. ¡o incluso contáctanos!                        
                </p>
                <p>
                    ¡Seguro que nos encantará discutirlo mientras hacemos un café!
                </p>
                <div class="contact-info">
                        <span id="contact-email"><a href="mailto:info@watchitfilms.es">info@watchitfilms.es</a></span>
                        <span id="contact-tel"><a href="tel:+34938614941">(+34)938 61 49 41 ext. 5179</a></span>
                        <span id="contact-address">
                            Centre Audiovisual Roca Umbert
                            Carrer d'Enric Prat de la Riba,77
                            08401 Granollers, Barcelona
                        </span>
                    </div>
                    <div class="contact-rrss">
                        <a class="rrss-items" target="_blank" href="https://www.youtube.com/channel/UCqoYKhGeL-YNxHZD_rs43ZA"><img src="{{asset('img/yt.svg')}}" alt="youtube"/></a>
                        <a class="rrss-items" target="_blank" href="https://www.facebook.com/watchitfilms"><img src="{{asset('img/fb.svg')}}" alt="youtube"/></a>
                        <a class="rrss-items" target="_blank" href="https://www.instagram.com/watchitfilms/"><img src="{{asset('img/insta.svg')}}" alt="youtube"/></a>
                    </div>
            </div>
            
        </div>
        <div class="col-12 col-md-6">
            <div class="spinner">
                <div class="spinner-loader">
                    <div class="double-bounce1"></div>
                    <div class="double-bounce2"></div>
                </div>
            </div>
            <form id ="contact-form" method="post">                
                <div class="form-group">
                    <input type="text" class="form-control form-contact" placeholder="Tu nombre"
                     id="contact_name" name="contact_name" required/>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control form-contact" placeholder="Nombre de tu empresa"
                     id="contact_enterprise" name="contact_enterprise" required />
                </div>                
                <div class="form-group">
                    <input type="email" class="form-control form-contact" placeholder="Tu email"
                     id="contact_email" name="contact_email" required/>
                </div>                
                <div class="form-group">
                    <textarea class="form-control form-contact" id="contact_message" name="contact_message" placeholder="Cuéntanos..." rows="5"></textarea>
                </div>
                <div class="form-check">
                        <label class="container">Al hacer click accepto la <a href="{{route('politica-privacidad')}}" target="_blank">política de privacidad</a>
                    <input type="checkbox" class="form-check-input" id="politica" name="politica" required>
                    <span class="checkmark"></span>
                  </label>
                    </div>
                <button type="submit" id="submit_contact" class="btn-contact"><span>Enviar</span></button>
            </form>            
        </div>
    </div>
</section>
@endsection