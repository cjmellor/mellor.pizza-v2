<x-layout.main :schema="[App\Seo\Seo::webPage('WebPage', 'privacy')]">
    <main>
        <x-page-head
            title="Privacy policy"
            label="Legal"
        >
            <flux:text class="lede">
                This site has one form, the contact form. This page explains what happens to what you send through it, and what else is
                collected when you visit.
            </flux:text>
        </x-page-head>

        <x-section
            title="Who is responsible for your data"
            label="Controller"
        >
            <flux:text class="copy">
                Mellor Code Ltd, company no. 17369266, registered in England and Wales, is the data controller. Registered office: 17
                Stroothers Place, Bradford, England, BD4 0BN. You can contact me at
                <flux:link href="mailto:chris@mellor.pizza">chris@mellor.pizza</flux:link>
                .
            </flux:text>
        </x-section>

        <x-section
            title="What I collect"
            label="Data"
        >
            <x-card>
                <ul class="list-bullets text-[15px]/[1.7]">
                    <li>
                        <strong>The contact form:</strong>
                        the name, email address and message you type in. The message is emailed to me. It isn't saved in a database on this
                        site.
                    </li>
                    <li>
                        <strong>Visit statistics:</strong>
                        page views, referrers, and browser and country information, collected by a self-hosted Umami instance. It doesn't
                        use cookies.
                    </li>
                    <li>
                        <strong>Cookies:</strong>
                        the site sets a session cookie and a security (CSRF) token cookie, which the contact form needs to work. They aren't
                        used for tracking or advertising.
                    </li>
                    <li>
                        <strong>Hosting:</strong>
                        the site sits behind Cloudflare, which processes your IP address and request details to deliver the site and block
                        abuse.
                    </li>
                    <li>
                        <strong>Fonts:</strong>
                        the site loads its fonts from Google Fonts, so your browser sends your IP address to Google when a page loads.
                    </li>
                </ul>
            </x-card>
        </x-section>

        <x-section
            title="Why, and on what basis"
            label="Purpose"
        >
            <flux:text class="copy">
                I use your name, email address and message to reply to your enquiry and, if you want to go ahead, to take steps towards a
                contract with you. The lawful basis is legitimate interests (answering people who contact me) or taking pre-contract steps
                at your request. I use the visit statistics to see which pages are read, on the basis of legitimate interests. I don't sell
                your data or use it for marketing.
            </flux:text>
        </x-section>

        <x-section
            title="Your rights"
            label="Rights"
        >
            <div class="space-y-4">
                <flux:text class="copy">
                    Under UK GDPR you can ask me for a copy of your personal data, ask me to correct or delete it, object to how I use it,
                    or ask me to restrict it. Email
                    <flux:link href="mailto:chris@mellor.pizza">chris@mellor.pizza</flux:link>
                    and I'll reply.
                </flux:text>
                <flux:text class="copy">
                    If you're unhappy with how I've handled your data, you can complain to the Information Commissioner's Office at
                    <flux:link
                        href="https://ico.org.uk"
                        target="_blank"
                    >
                        ico.org.uk
                    </flux:link>
                    .
                </flux:text>
            </div>
        </x-section>
    </main>
</x-layout.main>
