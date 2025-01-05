<%@ page import="java.io.File" %>
<%@ page import="java.nio.file.Paths" %>
<%@ page import="java.nio.file.Path" %>
<%@ page import="java.nio.file.Files" %>
<%@ page import="java.nio.charset.StandardCharsets" %>

<!DOCTYPE html>

<p>
<%
  String file = request.getParameter("file");
  
  if (file == null) {
     out.println("Need a file to read...<br/>");
     out.println("&nbsp;&nbsp;&nbsp;&nbsp; Start with me!<br/>");
     out.println("&nbsp;&nbsp;&nbsp;&nbsp; My name is: 'index.jsp'<br/>");
     out.println("Now, to you: which param is it? eheh");	     
  } else {

    // sanitize data for malicious
    file = file.replace("../", "");

    Path path = Paths.get(getServletContext().getRealPath("/") + "/" + file);
    byte[] data = Files.readAllBytes(path);
    String s = new String(data, StandardCharsets.UTF_8);
    out.println(s);
  }

%>
</p>

</html>
