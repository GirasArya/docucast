<div style="display: flex; align-items: center; gap: 0.625rem;">
    <img src="{{ asset('logo_dark.png') }}" alt="DocuCast" style="height: 40px;" class="docucast-logo-light">
    <img src="{{ asset('logo_light.png') }}" alt="DocuCast" style="height: 40px; display: none;" class="docucast-logo-dark">
    <span style="font-weight: 700; font-size: 1.125rem; letter-spacing: -0.01em;">DocuCast</span>
</div>
<style>
    .docucast-logo-light { display: block !important; }
    .docucast-logo-dark { display: none !important; }
    .dark .docucast-logo-light { display: none !important; }
    .dark .docucast-logo-dark { display: block !important; }
</style>
