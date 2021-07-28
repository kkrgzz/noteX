package com.kkrgzz.notexgithub;

public class urlClass {
    private String noteURL = "https://devrantakimi.com/notexNew/src/dbOperations/noteOperations.php";
    private String memberURL = "https://devrantakimi.com/notexNew/src/dbOperations/memberTransactions.php";

    private String localNoteURL = "http://192.168.1.23/noteX/src/dbOperations/noteOperations.php";
    private String localMemberURL = "http://192.168.1.23/noteX/src/dbOperations/memberTransactions.php";

    public String getNoteURL() {
        return noteURL;
    }

    public String getMemberURL() {
        return memberURL;
    }

    public String getLocalNoteURL() {
        return localNoteURL;
    }

    public String getLocalMemberURL() {
        return localMemberURL;
    }
}
