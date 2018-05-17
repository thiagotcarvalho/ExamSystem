import sys

def RunTestCases(funcname):
    correct = []
    #Split Function. To Name + individual parameters.
    functionNameAndPara = ''.join(c for c in funcname if c not in ',(){}<>')
    functionNameAndPara = functionNameAndPara.split()
    return functionNameAndPara
    
def FindDataType(s):
    try: 
        int(s)
        return int(s)
    except ValueError:
        try: 
            float(s)
            return float(s)
        except ValueError:
            return s


functionNameAndPara1 = RunTestCases(sys.argv[1])

print functionNameAndPara1[0]
