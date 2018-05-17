#!/usr/bin/python
#Creates a python file called RunStudentCode

import sys
num = len(sys.argv)

f= open("aaaStudent.py","w+")
f.write("#!/usr/bin/python")

#Write-out Students Answers to RunStudentCode.
#Each function is seperated by a newline character
for i in range(1, num):
    f.write("\n")
    rawans = sys.argv[i]
    ans = rawans.replace("[sp]", " ")
    f.write(ans)
    f.write("\n")

f.close()
