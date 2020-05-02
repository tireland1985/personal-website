let skillsList = [
    "Cisco IOS",
    "DHCP",
    "DNS",
    "Linux",
    "Bind9",
    "Microsoft Windows",
    "Active Directory",
    "Multilayer Switching",
    "Dynamic Routing",
    "EIGRP",
    "IPv6",
    "VMware ESXi",
    "HTML5",
    "CSS3",
    "Git",
    "GitHub",
    "Cisco Autonomous AP's"
];

let createLabels = function() {
    //event.preventDefault();
    //let candidateSkills = [];
    for(i=0;i<skillsList.length;i++){
        var allSkills = "<span class='label label-default'>" + skillsList[i] + "</span>";
        $("#skillsListContain").append(allSkills);
      }
      
      
      
      
     /* $(".label").on('click', function(){
         
         $(this).addClass("seld");
        candidateSkills.push($(this).text());
        
        //$(this).removeClass("label");
        
       
        
        var theSkill = $(this).text();
        
          $("#canSkillsContain").append("<div class='slider'><div class='selSkl'>" + theSkill + "</div><div class='slideContain'>slider here</div> </div>");
        
        })*/;
      
      
      
      
      
    }
    
     
    
    
    $(document).ready(function(){
      createLabels();
    });