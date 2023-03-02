<main id="cv-page">
    <div class="row"><!-- converted static cv.html file to a static template, dynamic version coming at a later date -->
        <div class="col s12 m12 center">
            <h1 class="center">CV</h1>
            <h2 class="center">Timothy Andrew Ireland</h2>
            <img src="/images/tim.jpg" alt="profile picture" class="profile center">
        </div>
    </div>

    <div class="cv-container">
        <div class="row">
            <div class="col s12 m12 center">
                <h2 class="header" id="education">Education:</h2>

                <div class="card horizontal center card-opacity-cv">
                    <div class="card-stacked">
                        <div class="card-content">
                            <h3>University of Northampton</h3>
                            <h4>2019 - 2022</h4>
                            <p class="cv-text">
                                BEng (Hons) Computer Networks Engineering (First Class)
                            </p>

                            <h3>Milton Keynes College</h3>
                            <p class="cv-text">
                                Cisco: Introduction to Networking (CCNA Module 1)<br />
                                BTEC First Diploma in Operations & Maintenance Engineering<br />
                                City & Guilds Level 1 Award in Applying Engineering Principles<br />
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12 m12 center">
                <h2 class="header" id="pro-exp">
                    Professional Experience:
                </h2>
                <div class="card horizontal center card-opacity-cv white-text">
                    <div class="card-stacked">
                        <div class="card-content">
                            <h4>W-Technology</h4>
                            <p class="cv-text">
                            Installed and configured a small business network with a Cisco ISR
                                    2911, and a Catalyst 2960.
                                    Configuration included providing Internet access (via a HWIC-1ADSL card),
                                    device segregation via VLANs and ACL's, as well as basic QoS for both VoIP devices
                                    and WiFi access.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card horizontal center card-opacity-cv white-text">
                    <div class="card-stacked">
                        <div class="card-content">
                            <a href="http://cosgrovepartnership.com">
                                <h4 class="linkcolour">The Cosgrove Partnership LLP</h4>
                            </a>
                            <p class="cv-text">
                            Provided guidance, assistance, as well as installation, networking
                                    and other services,
                                    including full-disk encryption, investigation into & subsequent decommissioning of
                                    an old server as well as old client machines,
                                    secure destruction of confidential computer files, and physical destruction of old
                                    hard drives.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m12 center">
                <h2 class="header" id="other-exp">
                    Other Experience:
                </h2>
                <img src="/images/homelab_1.jpg" alt="homelab picture" class="profile center">
                <div class="card horizontal center card-opacity-cv white-text">
                    <div class="card-stacked">
                        <div class="card-content">
                            <h4>Computer Systems &amp; Networking</h4>
                            <p class="cv-text">
                            My internal network currently consists of a Cisco ISR 2911, Catalyst
                                    3560G Multilayer Switch,
                                    and an Aironet 1141N running an autonomous image. Configuration includes Internet
                                    access via PPPoE,
                                    Private-VLAN's, ACL's, Dynamic Routing via EIGRP, TACACS authentication, 802.1x
                                    authentication via FreeRADIUS for a trusted WiFi Network,
                                    as well as standard WPA2-Personal for a Guest Network.
                            </p> <br />
                            <p class="cv-text">
                                    Also running a 3-host VMware ESXi cluster for learning: Dell R310,
                                    R420, and an Intel NUC7i5-BNH:
                                    VMs include, but are not limited to Windows Server for Active Directory/ Certificate
                                    Services, an NMS for centralised
                                    syslog storage & SNMP monitoring, and OpenVPN for remote access to my internal
                                    network.
                            </p><br />
                            <p class="cv-text">
                            Other hardware includes 4x Raspberry Pi's, running a collection of
                                    DHCP (ISC), DNS (Bind9 master/slave/dns-over-tls), TACACS and FreeRADIUS.
                                    As you can see from the picture, I also have a collection of older Cisco routers,
                                    switches, and a 2U case containing two mITX server systems,
                                    one running FreeNAS 11 (~20TB) providing both iSCSI storage for ESXi as well as
                                    fileshares over SMB and NFS,
                                    all contained within a 24U, 4 post open frame rack
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m12 center">
                <h2 class="header" id="skills">
                    Skills:
                </h2>
                <div class="card horizontal center card-opacity-cv white-text">
                    <div class="card-stacked">
                        <div class="card-content">
                            <!-- keeping the JavaScript array of skill names for now - will be changed at a later date -->
                            <div id="skillsListContain"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>