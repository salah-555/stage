@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">

<div class="contact-container">
    <h2>Contactez-nous</h2>
    <p class="subtitle">
        Une question ou une demande ? Remplissez le formulaire ci-dessous, nous vous répondrons rapidement !
    </p>

    <div class="contact-content">
        <!-- Section des informations -->
        <div class="contact-info">
            <h3>Nos Coordonnées</h3>
            <p><i class="icon-location"></i> 123 Rue du Commerce, Casablanca, Maroc</p>
            <p><i class="icon-phone"></i> +212 6 12 34 56 78</p>
            <p><i class="icon-email"></i> contact@monsite.com</p>

            <!-- Google Map -->
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26587.950401232996!2d-7.620904239550781!3d33.573110799999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda7cd9ab890a15f%3A0x596b5e75e8d6eac5!2sCasablanca!5e0!3m2!1sfr!2sma!4v1710341234567" 
                    allowfullscreen="" loading="lazy">
                </iframe>
            </div>
        </div>

        <!-- Formulaire de contact -->
        <div class="contact-form">
            <h3>Envoyez-nous un message</h3>
            <form action="#" method="POST">
                @csrf
                <label for="name">Nom complet</label>
                <input type="text" id="name" name="name" placeholder="Votre nom" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Votre email" required>

                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" placeholder="Votre message" required></textarea>

                <button type="submit">Envoyer</button>
            </form>
        </div>
    </div>
</div>
@endsection
